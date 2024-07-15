<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center">
            <img src="data:image/png;base64,<?php echo e($qrcode); ?>" alt="QR Code" class="img-fluid">
            <br>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Download QR Code
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="<?php echo e(route('download', ['format' => 'svg'])); ?>">Download SVG</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('download', ['format' => 'png'])); ?>">Download PNG</a></li>
                </ul>
            </div>
            <a href="/generate-qrcode" class="btn btn-primary mt-3">Generate another QR Code</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\99999355\Documents\QR Generator\qr-code-generator\resources\views/qrcode.blade.php ENDPATH**/ ?>