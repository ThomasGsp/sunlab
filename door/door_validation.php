<?php
require(dirname(__DIR__).'/common/config.php');
require(dirname(__DIR__).'/common/globalcon.php');
require(dirname(__DIR__).'/common/includes/dbconn.php');
require(dirname(__DIR__).'/common/includes/functions.php');
require(dirname(__DIR__).'/common/includes/newuserform.php');
require(dirname(__DIR__).'/common/includes/selectemail.php');
require(dirname(__DIR__).'/common/includes/mailsender.php');
require(dirname(__DIR__).'/common/includes/verify.php');

//Pulls variables from url. Can pass 1 (verified) or 0 (unverified/blocked) into url
$uid = $_GET['uid'];
$verify = $_GET['v'];

$e = new SelectEmail;
$eresult = $e->emailPull($uid);

$email = $eresult['email'];
$username = $eresult['username'];

$v = new Verify;
$txtbody = "";


if (isset($uid) && !empty(str_replace(' ', '', $uid)) && isset($verify)) {

    //Updates the verify column on user
    $vresponse = $v->doorvalidation($uid, $verify);

    //Success
    if ($vresponse == 'true') {
        $txtbody = $activemsg;

        //Send verification email
        $m = new MailSender;
        $m->sendMail($email, $username, $uid, 'door');
    } else {
        //Echoes error from MySQL
        $txtbody = $vresponse;
    }
} else {
    //Validation error from empty form variables
    $txtbody = 'An error occurred... click <a href="index.php">here</a> to go back';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="common/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="common/css/main.css" rel="stylesheet" media="screen">
        <meta charset="UTF-8">
        <title>Door validation</title>
    </head>
    <body>
        <div class="container">
            <div class="form-signin">
                <div class="alert alert-success"><?php echo $txtbody;  ?></strong></div>
                <a href="index.php">Index</a>
            </div>
        </div> <!-- /container -->
    </body>
</html>
