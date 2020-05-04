
<!doctype html>
<html lang="en">
<head>
    <title><?php echo !empty($title) ? $title : 'mySite'; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ASSETS_URI; ?>css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">mySite</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Registration</a>
            </li>
        </ul>
    </div>
</nav>

<main role="main">