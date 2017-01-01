<?php
// to do:
// Retour sur code erreur et non html direct
// Retour propre des erreurs mysql
// Revoir l'algo du maxappend



require(dirname(__DIR__).'/includes/dbconn.php');

class LoginForm
{


    private function testldap($myusername, $mypassword)
    {
        $data = $this->getinfouser($myusername);

        require(dirname(__DIR__).'/connectors/ldap.php');
        $ldapconnection = ldaplogin("uid=".$myusername, $mypassword);
        $ldapconnection = json_decode($ldapconnection);

        if ($ldapconnection->result)
            return $data;
        else
            return false;

    }

    private function testlocal($myusername, $mypassword)
    {

        $data = $this->getinfouser($myusername);

        if (!empty($data))
        {
            if (password_verify($mypassword, $data->password) || md5($mypassword) == $data->password)
                return $data;
            else
                return false;
        }
        else
            return false;

    }

    private function getinfouser($myusername)
    {
        $db = new DbConn;
        $tbl_members = $db->tbl_members;

        $stmt = $db->conn->prepare("SELECT * FROM ".$tbl_members." WHERE username = :myusername");
        $stmt->bindParam(':myusername', $myusername);
        $stmt->execute();

        // Gets query result
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }


    public function checkLogin($myusername, $mypassword, $page="")
    {
        $conf = new GlobalConf;
        $ip_address = $conf->ip_address;
        $login_timeout = $conf->login_timeout;
        $max_attempts = $conf->max_attempts;
        $timeout_minutes = $conf->timeout_minutes;
        $attcheck = checkAttempts($myusername);
        $curr_attempts = $attcheck['attempts'];
        $mod_ldap = $conf->mod_ldap;
        $datetimeNow = date("Y-m-d H:i:s");
        $oldTime = strtotime($attcheck['lastlogin']);
        $newTime = strtotime($datetimeNow);
        $timeDiff = $newTime - $oldTime;


        if ($curr_attempts >= $max_attempts && $timeDiff < $login_timeout)
        {
            $success = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Nombre de tentatives max atteintes...  ".$timeout_minutes." minutes avant le déblocage</div>";
        }
        else
        {
            $local = $this->testlocal($myusername, $mypassword);

            if ($mod_ldap == true and  $local == false)
                $ldap = $this->testldap($myusername, $mypassword);
            else
                $ldap = false;


            if ($page == "members") // test pour la page de membre
            {
                if ($local)
                {
                    $member = new _register();
                    $member->username = $myusername;
                    $member->ip = get_client_ip();
                    $datetimeNow = date("Y-m-d H:i:s");
                    $member->date = $datetimeNow;
                    $member->member();
                    $success = "<div class=\"alert alert-info alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Bonjour ".$local->firstname." ".$local->name."! Vous êtes bien enregistré pour cette séance !<script type='text/JavaScript'> setTimeout('location.href = \"index.php\";', 7000);</script></div>";
                }
                elseif ($ldap)
                {
                    $member = new _register();
                    $member->username = $myusername;
                    $member->regtype = "ldap";
                    $member->ip = get_client_ip();
                    $datetimeNow = date("Y-m-d H:i:s");
                    $member->date = $datetimeNow;
                    $member->member();
                    $success = "<div class=\"alert alert-info alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\"> &times;</button> Bonjour ".$ldap->firstname." ".$ldap->name." ! Vous êtes bien enregistré pour cette séance !<script type='text/JavaScript'> setTimeout('location.href = \"index.php\";', 7000);</script></div>";
                }
                else
                {
                    $success = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Mauvais utilisateur ou mot de passe.</div>";
                }
            }
            elseif ($page == "door" || $page == "gestion")
            {
                if ($local || $ldap)
                {
                    if ($local->verified == '1' || $ldap->verified == '1') // acces compte valide
                    {
                        $success = 'true';
                        session_start();
                        $_SESSION['username'] = $myusername;
                    }
                    elseif ($local->verified == '0'  || $ldap->verified == '0')
                    {
                        //Account not yet verified
                        $success = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Votre compte a été créé, mais n'est pas encore vérifié par un administrateur.</div>";
                    }
                }
                else
                {
                    $success = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Mauvais utilisateur ou mot de passe.</div>";
                }
            }
            else
                $success ='';

        }
        return $success;
    }

    public function insertAttempt($username)
    {
        try {
            $db = new DbConn;
            $conf = new GlobalConf;
            $tbl_attempts = $db->tbl_attempts;
            $ip_address = $conf->ip_address;
            $login_timeout = $conf->login_timeout;
            $max_attempts = $conf->max_attempts;

            $datetimeNow = date("Y-m-d H:i:s");
            $attcheck = checkAttempts($username);
            $curr_attempts = $attcheck['attempts'];

            $stmt = $db->conn->prepare("INSERT INTO ".$tbl_attempts." (ip, attempts, lastlogin, username) values(:ip, 1, :lastlogin, :username)");
            $stmt->bindParam(':ip', $ip_address);
            $stmt->bindParam(':lastlogin', $datetimeNow);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $curr_attempts++;
            $err = '';

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }

        //Determines returned value ('true' or error code)
        $resp = ($err == '') ? 'true' : $err;

        return $resp;

    }

    public function updateAttempts($username)
    {
        try {
            $db = new DbConn;
            $conf = new GlobalConf;
            $tbl_attempts = $db->tbl_attempts;
            $ip_address = $conf->ip_address;
            $login_timeout = $conf->login_timeout;
            $max_attempts = $conf->max_attempts;
            $timeout_minutes = $conf->timeout_minutes;

            $att = new LoginForm;
            $attcheck = checkAttempts($username);
            $curr_attempts = $attcheck['attempts'];

            $datetimeNow = date("Y-m-d H:i:s");
            $oldTime = strtotime($attcheck['lastlogin']);
            $newTime = strtotime($datetimeNow);
            $timeDiff = $newTime - $oldTime;

            $err = '';
            $sql = '';


             // REVOIR l'ALGO DE CETTE PARTIE !!!
            if ($curr_attempts >= $max_attempts && $timeDiff < $login_timeout)
            {

                if ($timeDiff >= $login_timeout) {

                    $sql = "UPDATE ".$tbl_attempts." SET attempts = :attempts, lastlogin = :lastlogin where ip = :ip and username = :username";
                    $curr_attempts = 1;

                }

            } else {

                if ($timeDiff < $login_timeout) {

                    $sql = "UPDATE ".$tbl_attempts." SET attempts = :attempts, lastlogin = :lastlogin where ip = :ip and username = :username";
                    $curr_attempts++;

                } elseif ($timeDiff >= $login_timeout) {

                    $sql = "UPDATE ".$tbl_attempts." SET attempts = :attempts, lastlogin = :lastlogin where ip = :ip and username = :username";
                    $curr_attempts = 1;

                }

                $stmt2 = $db->conn->prepare($sql);
                $stmt2->bindParam(':attempts', $curr_attempts);
                $stmt2->bindParam(':ip', $ip_address);
                $stmt2->bindParam(':lastlogin', $datetimeNow);
                $stmt2->bindParam(':username', $username);
                $stmt2->execute();

            }

        } catch (PDOException $e) {

            $err = "Error: " . $e->getMessage();

        }

        //Determines returned value ('true' or error code) (ternary)
        $resp = ($err == '') ? 'true' : $err;

        return $resp;

    }

}
