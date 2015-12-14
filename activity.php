<?php

/**
 * Activity Logging
 *
 * This file is part of Launchrock TagHost.
 *
 * @package launchrock_taghost
 * @version 0.4
 * @author James Inglis <hello@jamesinglis.no>
 * @copyright (c) 2015, James Inglis
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 */

require_once 'config.php';
require_once 'tag-templates.php';
require_once 'functions.php';

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$email = "";
$status = "";
$ref = "";
$nonce = "";
$ip_address = get_client_ip();
$error = false;
$error_messages = array();

if (array_key_exists("email", $_POST) && strlen($_POST['email']) > 0) {
    $email = trim($_POST['email']);
} else {
    $error = true;
    $error_messages[] = "Email not set";
}

if (array_key_exists("status", $_POST) && strlen($_POST['status']) > 0) {
    $status = trim($_POST['status']);
} else {
    $error = true;
    $error_messages[] = "Status not set";
}

if (array_key_exists("nonce", $_POST) && strlen($_POST['nonce']) > 0 && NonceUtil::check(get_config("logging_nonce"), $_POST['nonce'])) {
    $nonce = trim($_POST['nonce']);
} else {
    $error = true;
}

if (array_key_exists("status", $_POST) && strlen($_POST['status']) > 0) {
    $ref = trim($_POST['ref']);
}

if ($error === false) {
    $fields = array(date('Y-m-d H:i:s O'), $email, $status, $ip_address, $ref);

    $fh = fopen('activity.log', 'a');
    fputcsv($fh, $fields);
    fclose($fh);
    $return_message = array(
        'status' => "Success",
        'message' => array("Activity Logged"),
    );
} else {
    $return_message = array(
        'status' => "Error",
        'message' => $error_messages,
    );
}

header('Content-Type: application/json');
echo json_encode($return_message);