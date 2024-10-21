<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

add_hook('AdminAreaHeadOutput', 1, function($vars) {
    $headOutput = '<link href="' . $vars['WEB_ROOT'] . '/modules/addons/mycrud/css/bootstrap.min.css" rel="stylesheet" type="text/css" />';
    //return $headOutput;
});