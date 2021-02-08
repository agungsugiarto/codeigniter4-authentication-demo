<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= csrf_meta() ?>

    <title>CodeIgniter 4</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="<?= site_url('css/app.css') ?>">
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        <?= $this->renderSection('content') ?>
    </div>
</body>
<!-- Scripts -->
<script src="<?= site_url('js/app.js') ?>" defer></script>
</html>