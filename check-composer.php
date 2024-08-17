<?php
if (file_exists('composer.json') && (filemtime('composer.json') > filemtime('composer.lock') || !file_exists('vendor/autoload.php'))) {
    exit(0);
} else {
    exit(1);
}

