<!doctype html>
<html lang="en">
<head>
    <title>Qr</title>

    <link href="<?php echo ASSETS_URI; ?>css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container" style="padding-top: 6rem;">
    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-sm">
                <img src="<?php echo $qrCodeUrl; ?>">
                <a href="/verify" class="btn btn-outline-primary" style="margin-top: 2rem;">Я сканировал код!</a>
        </div>
        <div class="col-sm">
        </div>
    </div>
</div>