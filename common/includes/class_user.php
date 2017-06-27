<?php

require_once(dirname(__DIR__).'/includes/dbconn.php');

class _user_informations
{
    var $id;
    var $username;
    var $name;
    var $firstname;
    var $phone;
    var $email;
    var $verified;
    var $admin;
    var $picture;


    function getuserinfo()
    {
        try {

            $db = new DbConn;
            $tbl_attempts = $db->tbl_members;
            $sql = "SELECT * FROM ".$tbl_attempts." WHERE Username = :username";
            $stmt = $db->conn->prepare($sql);
            $stmt->bindParam(':username', $this->username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result;

        } catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }

        //Determines returned value ('true' or error code)
        $resp = ($err == '') ? 'true' : $err;
        return $resp;
    }

    function deleteaccount()
    {
        try {
            $db = new DbConn;
            $tbl_members = $db->tbl_members;
            $stmt = $db->conn->prepare("DELETE FROM ".$tbl_members." WHERE id = '".$this->id."' LIMIT 1");
            $stmt->execute();
            $err = '';
        }
        catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }
        //Determines returned value ('true' or error code)
        if ($err == '') {
            $success = 'true';
        } else {
            $success = $err;
        };
        return $success;
    }

    function changevalue($type, $newvalue)
    {
        try {
            $db = new DbConn;
            $tbl_members = $db->tbl_members;
            $stmt = $db->conn->prepare("UPDATE ".$tbl_members." SET ".htmlspecialchars($type)."=:newvalue WHERE id=:id");;
            $stmt->bindParam(":newvalue",$newvalue);
            $stmt->bindParam(":id",$this->id);
            $stmt->execute();
            $err = '';
        }
        catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }
        //Determines returned value ('true' or error code)
        if ($err == '') {
            $success = 'true';
        } else {
            $success = $err;
        };
        return $success;
    }
}