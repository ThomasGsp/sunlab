<?php

function ldaplogin($username, $password)
{
    require 'ldap.conf.php';

    $ldaprdn = $username.','.$ldapOrgUnit.','.$baseDN;



    $ldap = @ldap_connect($ldapserver);

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

    $userinfo = array();
    if ($bind)
    {
        $filter = "sn=*";
        $result = ldap_search($ldap, $ldaprdn, $filter);
        $info = ldap_get_entries($ldap, $result);
        $i = "0";

        $userinfo['result'] = true;
        $userinfo['username'] = $info[$i]["uid"][0] ;
        $userinfo['name'] = $info[$i]["sn"][0];
        $userinfo['firstname'] = $info[$i]["givenname"][0];
        $userinfo['email'] = $info[$i]["mail"][0];

        ldap_close($ldap);
    }
    else
    {
        $userinfo['result'] = false;
    }


    return  json_encode($userinfo);
}

/**
 * Retrive all the currently active users from LDAP and serves the list
 * 
 * @return array list of users as array of array('username', 'picture', 'role')
 */
function ldapGetFacebook() 
{
  require 'ldap.conf.php';

  $ldaprdn = $ldapServerAccount.','.$ldapOrgUnit.','.$baseDN;

  $ldap = @ldap_connect($ldapserver);

  ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

  $bind = @ldap_bind($ldap, $ldaprdn, $ldapServerPwd);

  $userList = array();
  
  if($bind)
  {
      $filter = "sn=*";
      $result = ldap_search($ldap, $ldaprdn, $filter);
      $info = ldap_get_entries($ldap, $result);
      $usersData = array();
      
      for($i=0 ; $i<1 ; $i++) {
        $userData['username'] = $info[$i]["uid"][0] ;
        $userData['picture'] = "TODO";
      }
      $userList[] = $userData;
      
      ldap_close($ldap);
  }
  else
  {
      $userinfo['result'] = false;
  }


  return  json_encode($userinfo);  

}
