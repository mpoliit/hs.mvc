
<!doctype html>
<html lang="en">
<head>
    <title><?php echo !empty($title) ? $title : 'mySite'; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ASSETS_URI; ?>css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<?php show_alert(); ?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">mySite</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/home">Главная</a>
            </li>
            <?php if (!\Helpers\SessionHelpers::isUserLogin()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login/">Авторизация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/registration/">Регистрация</a>
                </li>
            <?php endif; ?>
            <?php if (\Helpers\SessionHelpers::isUserLogin()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/post/create/">Создать новость</a>
                </li>
            <?php endif; ?>
        </ul>
        <?php if (\Helpers\SessionHelpers::isUserLogin()): ?>
        <ul class="navbar-nav float-right">
            <li class="nav-item active">
                <a class="nav-link" href="#"><?php echo \Helpers\SessionHelpers::getUserData('name');?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout/">Выход</a>
            </li>
        </ul>


        <?php endif; ?>
    </div>
</nav>

<main role="main">
    <?php show_alert(); ?>