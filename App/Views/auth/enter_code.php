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
                <form method="post" action="/2auth-verify/">
                    <div class="form-group">
                        <label for="qr-code">Пароль</label>
                        <input type="text"
                               class="form-control"
                               id="qr-code"
                               name="qr-code"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary">Подтвердить</button>
                </form>
        </div>
        <div class="col-sm">
        </div>
    </div>
</div>