<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">QR Code Generator</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/generate-qrcode" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="link" class="form-label">Enter the URL:</label>
                        <input type="url" id="link" name="link" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="size" class="form-label">Select Size:</label>
                        <select id="size" name="size" class="form-select" required>
                            <option value="500">500 x 500 px</option>
                            <option value="1000">1000 x 1000 px</option>
                            <option value="2000">2000 x 2000 px</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Upload Logo (optional):</label>
                        <input type="file" id="logo" name="logo" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Generate QR Code</button>
                </form>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\99999355\Documents\QR Generator\qr-code-generator\resources\views/qrcode_form.blade.php ENDPATH**/ ?>