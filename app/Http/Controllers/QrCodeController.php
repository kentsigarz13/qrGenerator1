<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Logo\Logo;

class QrCodeController extends Controller
{
    public function showForm()
    {
        return view('qrcode_form');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'size' => 'required|in:500,1000,2000',
            'logo' => 'nullable|image|max:2048' // Validate the logo if provided
        ]);

        $link = $request->input('link');
        $size = (int)$request->input('size');

        // Create QR code
        $qrCode = QrCode::create($link)
            ->setSize($size)
            ->setMargin(10);

        // Add logo if provided
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $logo = Logo::create(storage_path('app/public/' . $logoPath))
                ->setResizeToWidth($size / 4); // Resize logo to fit in the center
        } else {
            $logo = null;
        }

        // Generate QR code with or without logo
        $writer = new PngWriter();
        $result = $writer->write($qrCode, $logo);

        // Store the data in session
        Session::put('qrcode_data', [
            'link' => $link,
            'size' => $size,
            'logo' => $logoPath ?? null
        ]);

        return view('qrcode', ['qrcode' => base64_encode($result->getString())]);
    }

    public function download($format)
    {
        $qrcode_data = Session::get('qrcode_data');

        if (!$qrcode_data) {
            abort(404, 'No QR code data found. Please generate a QR code first.');
        }

        $qrCode = QrCode::create($qrcode_data['link'])
            ->setSize($qrcode_data['size'])
            ->setMargin(10);

        // Add logo if it was provided
        if ($qrcode_data['logo']) {
            $logo = Logo::create(storage_path('app/public/' . $qrcode_data['logo']))
                ->setResizeToWidth($qrcode_data['size'] / 4); // Resize logo to fit in the center
        } else {
            $logo = null;
        }

        if ($format == 'svg') {
            $writer = new SvgWriter();
            $result = $writer->write($qrCode, $logo);
            $response = response($result->getString())->header('Content-Type', 'image/svg+xml');
            $filename = 'qrcode.svg';
        } elseif ($format == 'png') {
            $writer = new PngWriter();
            $result = $writer->write($qrCode, $logo);
            $response = response($result->getString())->header('Content-Type', 'image/png');
            $filename = 'qrcode.png';
        } else {
            abort(404);
        }

        return $response->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}