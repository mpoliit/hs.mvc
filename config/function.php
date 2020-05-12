<?php

function redirect($patch = '')
{
    header("Location: " . SITE_URL . "/" . $patch);
}

function show_alert()
{
    if(isset($_SESSION['notification'])){
        ?>
            <div class="alert alert-<?php echo $_SESSION['notification']['type']; ?>" role="alert" style="z-index: 9999;">
                <?php echo $_SESSION['notification']['message']; ?>
            </div>
        <?php
       unset($_SESSION['notification']);
   }
}

function debug($value, $die = true)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';

    if ($die){
        die();
    }
}