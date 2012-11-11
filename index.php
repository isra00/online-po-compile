<?php

include 'init.php';
require 'lib/misc.php';

if (isset($_POST['submit'])) {

    @session_start();
    define('FILE_ID', uniqid('onlinepoconverter', true));
    $_SESSION['file_id'] = FILE_ID;

    require 'lib/recaptchalib.php';
    $captcha = recaptcha_check_answer(RECAPTCHA_PRIV, $_SERVER["REMOTE_ADDR"], 
        $_POST["recaptcha_challenge_field"], 
        $_POST["recaptcha_response_field"]);

    // FORM VALIDATION

    $errors = array();

    if (!$captcha->is_valid) {
        $errors['captcha'] = 'Please enter the valid anti-robots text';
    }
    
    $up = $_FILES['up'];
    
    if (!isset($up['type'])) {
        $errors['up'] = 'Sorry, but your file could not be uploaded. Please, try again or contact me in ' . CONTACT;
        goto VIEW;
    }
    
    if ($up['type'] != 'text/x-gettext-translation') {
        $errors['up'] = 'The uploaded file is not a valid .po file';
    }
    
    if ($up['size'] > MAX_FILE_SIZE) {
        $errors['up'] = 'Sorry, but the file you uploaded is too big. Only files smaller than ' . formatRawSize(MAX_FILE_SIZE) . ' are accepted';
    }
    
    $local_file = dirname(TMP_DIR) . '/' . FILE_ID . '.po';
    
    if ($up['error'] || !move_uploaded_file($up['tmp_name'], $local_file)) {
        $errors['up'] = 'Sorry, but your file could not be uploaded. Please, try again or contact me in ' . CONTACT;
    }
    
    if (!empty($errors)) {
        print_r($errors);
        goto VIEW;
    }
}


VIEW:
include 'index.view.php';
