<?php
//PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();
if (!isset($_SESSION['username'])) {
    header("location:gestion_login.php");
    exit(0);
}

require(dirname(__DIR__).'/common/config.php');
require(dirname(__DIR__).'/common/includes/functions.php');
require(dirname(__DIR__).'/common/includes/class_user.php');
require(dirname(__DIR__).'/common/includes/userinfo.php');

$_SESSION['gestion'] = 'yes';

if ($user->admin == 1)
    header("location:user_admin.php");
else
    header("location:user_member.php");
exit(0);
