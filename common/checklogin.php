<?php
//DO NOT ECHO ANYTHING ON THIS PAGE OTHER THAN RESPONSE
//'true' triggers login success
ob_start();
require(dirname(__DIR__).'/common/config.php');
require(dirname(__DIR__).'/common/includes/globalconf.php');
require(dirname(__DIR__).'/common/includes/loginform.php');
require(dirname(__DIR__).'/common/includes/functions.php');
require(dirname(__DIR__).'/common/includes/respobj.php');
require(dirname(__DIR__).'/register/includes/class_register.php');


// Define $myusername and $password
$username = base64_decode($_POST['myusername']);
$password = base64_decode($_POST['password']);
$page = $_POST['page'];

// To protect MySQL injection
$username = addslashes($username);
$password = addslashes($password);
$page =  addslashes($page);
$response = '';
$loginCtl = new LoginForm;
$conf = new GlobalConf;
$lastAttempt = checkAttempts($username);
$max_attempts = $conf->max_attempts;

//First Attempt
if ($lastAttempt['lastlogin'] == '') {

    $lastlogin = 'never';
    $loginCtl->insertAttempt($username);
    $response = $loginCtl->checkLogin($username, $password, $page);

} elseif ($lastAttempt['attempts'] >= $max_attempts) {

    //Exceeded max attempts
    $loginCtl->updateAttempts($username);
    $response = $loginCtl->checkLogin($username, $password , $page);

} else {

    $response = $loginCtl->checkLogin($username, $password, $page);

};

if ($lastAttempt['attempts'] < $max_attempts && $response['code'] != true)
{
    $loginCtl->updateAttempts($username);
    $resp = new RespObj($username, $response['text']);
    $jsonResp = json_encode($resp);
    echo $jsonResp;

} else {

    $resp = new RespObj($username, $response['text']);
    $jsonResp = json_encode($resp);
    echo $jsonResp;

}

unset($resp, $jsonResp);
ob_end_flush();
