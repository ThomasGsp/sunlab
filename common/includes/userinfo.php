<?php
//DO NOT ECHO ANYTHING ON THIS PAGE OTHER THAN RESPONSE
//'true' triggers login success
ob_start();

$getinfouser = new _user_informations();
$getinfouser->username = $_SESSION['username'];
$user = $getinfouser->getuserinfo();
$getinfouser->id = $user->id;


