<?php

include 'init.php';

$files = new DirectoryIterator(TMP_DIR);

foreach ($files as $file) {

    $now = time();

    if (!$file->isDot()) {
        if ($now - $file->getMTime() > 3600) {
            unlink($file->getPathname());
        }
    }
}
