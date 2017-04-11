<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:gestion_login.php");
    exit(0);
}

require(dirname(__DIR__).'/config.php');
require(dirname(__DIR__).'/includes/functions.php');
require(dirname(__DIR__).'/includes/selectemail.php');
require(dirname(__DIR__).'/includes/class_user.php');

$currentuser = new _user_informations();
$currentuser->username = $_SESSION['username'];
$currentuserinfo = $currentuser->getuserinfo();

$changeuser = new _user_informations();
if (isset($_GET['username']) and $currentuserinfo->admin == 1) {
    $changeuser->username = $_GET['username'];
}
else{
    $changeuser->username = $_SESSION['username'];
}

$changeuserinfo = $changeuser->getuserinfo();
$changeuser->id =  $changeuserinfo->id;
$changeuser->email =  $changeuserinfo->email;

$uncryptpw = generateRandomString();
$newpw = password_hash($uncryptpw, PASSWORD_DEFAULT);
$updatepw = $changeuser->changevalue("password", $newpw);


if($updatepw == "true") {
    //Send verification email
    $m = new MailSender;
    $m->newpw = $uncryptpw;
    error_log($changeuser->email, $changeuser->username, "", "resetpw");
    $m->sendMail($changeuser->email, $changeuser->username, "", "resetpw");
    echo "Nouveau mot de passe envoyé par mail à l'utilisateur.";
}
else{
    echo "Une erreur est survenue";
}