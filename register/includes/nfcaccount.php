<?php
require('../common/config.php');
require('../common/includes/dbconn.php');
require('../common/includes/functions.php');
require('../includes/class_register.php');
require('../nfc/includes/getid.php');
$message['result'] = false;

if (!empty($uidcard)){
    require('../nfc/includes/checkuser.php');
    $user = checkuser(substr(hash('sha1', $uidcard), 0, 10));
    if ($user != null) {
        $guest = new _register();
        $guest->username = $user;
        $guest->ip = get_client_ip();
        $datetimeNow = date("Y-m-d H:i:s");
        $guest->date = $datetimeNow;
        $guest->regtype = "nfc";
        $guest->member();
        $message=array();
        $message['result'] = true;
        $message['msg'] = "Bonjour ".$guest->username."! Vous êtes bien enregistré pour cette séance via votre carte nfc !";
    }
}
echo  json_encode($message);