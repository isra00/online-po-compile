<?php

/**
 * FORMAT RAW SIZE FOR FRIENDLY DISPLAY
 *
 * @param int $bytes Size in bytes.
 * @return string Human-readable file size.
 *
 * @url http://www.stemkoski.com/how-to-format-raw-byte-file-size-into-a-humanly-readable-value-using-php/
 */
function formatRawSize($bytes) {
    if(!empty($bytes)) {

        $s = array('bytes', 'kb', 'MB', 'GB', 'TB', 'PB');
        $e = floor(log($bytes)/log(1024));

        $output = sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e))));

        return $output;
    }
}
