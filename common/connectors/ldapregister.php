<?php

require 'ldap.php';

if(!empty($_POST['usernameldap']) && !empty($_POST['passwordldap']))
{

    $username = 'uid='.addslashes($_POST['usernameldap']);
    $password = addslashes($_POST['passwordldap']);
    $ldapconnection = ldaplogin($username, $password);
    echo $ldapconnection;
}
else
{
    $userinfo['result'] = false;
    $userinfo['msg'] = "Merci de complèter tous les champs.";
    echo  json_encode($userinfo);
}