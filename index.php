<?php

include 'init.php';
require 'lib/misc.php';

if (isset($_POST['submit'])) {

    @session_start();
    define('FILE_ID', md5(uniqid('onlinepoconverter', true)));
    $_SESSION['file_id'] = FILE_ID;

    require 'lib/recaptchalib.php';
    $captcha = recaptcha_check_answer(RECAPTCHA_PRIV, $_SERVER["REMOTE_ADDR"], 
        $_POST["recaptcha_challenge_field"], 
        $_POST["recaptcha_response_field"]);

    // FORM VALIDATION

    $errors = array();

    if (!$captcha->is_valid && !(ALLOW_NOCAPTCHA == true && isset($_GET['nocaptcha']))) {
        $errors['captcha'] = 'Please enter the valid anti-robots text';
        goto VIEW;
    }
    
    $internal_error_message = 'Sorry, but your file could not be uploaded. Please, try again or contact me in ' . CONTACT;
    
    $up = $_FILES['up'];
    
    if (!isset($up['type'])) {
        $errors['up'] = $internal_error_message;
        goto VIEW;
    }
    
	/** FIXME el MIME no vale porque Chrome/Windows envía application/octet-stream!!! Comprobar de otra forma */
	//Ver  http://www.php.net/manual/es/ref.fileinfo.php
    if ($up['type'] != 'text/x-gettext-translation') {
        //$errors['up'] = 'The uploaded file is not a valid .po file: ' . $up['type'];
    }
    
    if ($up['size'] > MAX_FILE_SIZE) {
        $errors['up'] = 'Sorry, but the file you uploaded is too big. Only files smaller than ' . formatRawSize(MAX_FILE_SIZE) . ' are accepted';
    }
    
    $local_file = realpath(TMP_DIR) . '/' . FILE_ID . '.po';
    
    if ($up['error']) {
        $errors['up'] = $internal_error_message;
    }
    
    if (!empty($errors)) {
        goto VIEW;
    }
    
    if (!($res = move_uploaded_file($up['tmp_name'], $local_file))) {
        $errors['up'] = $internal_error_message;
    }
    
    $local_compiled_file = FILE_ID . '.mo';
    
    $compile_output = '';
    $compile_cmd = "cd " . TMP_DIR . " && msgfmt -o $local_compiled_file " . FILE_ID . ".po";
    $compile_status = exec_cmd($compile_cmd, $compile_output);
    
    if (!$compile_status) {
        $errors[] = 'Sorry, but your file could not be converted. Details: <br><pre>' . join("\n", $compile_output) . '</pre>';
    } else {
        $deliver = true;
        $download_url = FILES_PUBLIC . '/' . FILE_ID . '.mo';
    }
}

VIEW:
include 'index.view.php';
