<?php

function redirect($patch = ''){
    header("Location: " . SITE_URL . "/" . $patch);
}