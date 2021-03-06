<?php

include 'init.php';
require 'lib/misc.php';

if (isset($_POST['submit']))
{

    @session_start();
    define('FILE_ID', md5(uniqid('onlinepoconverter', true)));
    $_SESSION['file_id'] = FILE_ID;

    require 'lib/recaptchalib.php';
    $captcha = recaptcha_check_answer(RECAPTCHA_PRIV, 
            $_SERVER["REMOTE_ADDR"], 
            $_POST["recaptcha_challenge_field"], 
            $_POST["recaptcha_response_field"]);

    // FORM VALIDATION

    $errors = array();

    if (!$captcha->is_valid && !(ALLOW_NOCAPTCHA == true && isset($_GET['nocaptcha'])))
    {
        $errors['captcha'] = 'Please enter the valid anti-robots text';
        goto VIEW;
    }

    $internal_error_message = 'Sorry, but your file could not be uploaded. Please, try again or contact me in ' . CONTACT;

    $up = $_FILES['up'];

    if (!isset($up['type']))
    {
        $errors['up'] = $internal_error_message;
        goto VIEW;
    }

    $file_info = new finfo(FILEINFO_MIME_TYPE);
    if ('text/x-po' != $file_info->file($up['tmp_name']))
    {
        $errors['up'] = 'The uploaded file is not a valid .po file, but a <em>' . $up['type'] . '</em>.';
    }
    unset($file_info);

    if ($up['size'] > MAX_FILE_SIZE)
    {
        $errors['up'] = 'Sorry, but the file you uploaded is too big. Only files smaller than ' . formatRawSize(MAX_FILE_SIZE) . ' are accepted';
    }

    $local_file = realpath(TMP_DIR) . '/' . FILE_ID . '.po';

    /**
     * 
     * Error del usuario o conexión:
     * UPLOAD_ERR_PARTIAL
     * UPLOAD_ERR_NO_FILE
     * 
     * Error del servidor:
     * UPLOAD_ERR_NO_TMP_DIR
     * UPLOAD_ERR_CANT_WRITE
     * UPLOAD_ERR_EXTENSION 
     */
    if (in_array($up['error'], array(UPLOAD_ERR_NO_TMP_DIR, UPLOAD_ERR_CANT_WRITE, UPLOAD_ERR_EXTENSION)))
    {
        $errors['up'] = $internal_error_message;
    }

    if (!empty($errors))
    {
        goto VIEW;
    }

    if (!($res = move_uploaded_file($up['tmp_name'], $local_file)))
    {
        $errors['up'] = $internal_error_message;
    }

    $local_compiled_file = FILE_ID . '.mo';

    $compile_output = '';
    $compile_cmd = "cd " . TMP_DIR . " && msgfmt -o $local_compiled_file " . FILE_ID . ".po";
    $compile_status = exec_cmd($compile_cmd, $compile_output);

    if (!$compile_status)
    {
        $errors[] = 'Sorry, but your file could not be converted. Details: <br><pre>' . join("\n", $compile_output) . '</pre>';
    } else
    {
        $deliver = true;
        $download_url = FILES_PUBLIC . '/' . FILE_ID . '.mo';
    }

    mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
    mysql_select_db(MYSQL_SCHEMA);

    $filename = mysql_real_escape_string($up['name']);
    $compilation_time = null; // Not implemented... yet.
    $filesize_po = mysql_real_escape_string(filesize($local_file));
    $filesize_mo = mysql_real_escape_string(filesize(TMP_DIR . '/' . $local_compiled_file));
    $file_id = mysql_real_escape_string(FILE_ID);

    $sql_insert = <<<SQL
INSERT INTO pocompiler_log (
    time, 
    filename, 
    compilation_time, 
    filesize_po, 
    filesize_mo, 
    file_id
) VALUES (
    NOW(),
    '$filename',
    '$compilation_time',
    '$filesize_po',
    '$filesize_mo',
    '$file_id'
)
SQL;

    mysql_query($sql_insert);

    unlink($local_file);
}

VIEW:
include 'index.view.php';
