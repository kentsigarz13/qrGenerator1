<?php
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

// Redirect the root URL to /generate-qrcode
Route::get('/', function () {
    return redirect('/generate-qrcode');
});

Route::get('/generate-qrcode', [QrCodeController::class, 'showForm']);
Route::post('/generate-qrcode', [QrCodeController::class, 'generate']);
Route::get('/download/{format}', [QrCodeController::class, 'download'])->name('download');