<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function mySqlErrors($response)
{
    //Returns custom error messages instead of MySQL errors
    switch (substr($response, 0, 22)) {

        case 'Error: SQLSTATE[23000]':
            echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Ce nom d'utilisateur ou cette adresse mail est déjà existante.</div>";
            break;

        default:
            echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Une erreur est survenue. Essayez de nouveau ou contactez un administrateur.</div>";

    }
};

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function getallusers()
{
    try {

        $db = new DbConn;
        $tbl_attempts = $db->tbl_members;

        $sql = "SELECT * FROM ".$tbl_attempts;
        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;


    } catch (PDOException $e) {
        $err = "Error: " . $e->getMessage();
    }

    //Determines returned value ('true' or error code)
    $resp = ($err == '') ? 'true' : $err;
    return $resp;
}

function checkAttempts($username)
{

    try {

        $db = new DbConn;
        $conf = new GlobalConf;
        $tbl_attempts = $db->tbl_attempts;
        $ip_address = $conf->ip_address;

        $sql = "SELECT Attempts as attempts, lastlogin FROM ".$tbl_attempts." WHERE IP = :ip and Username = :username";

        $stmt = $db->conn->prepare($sql);
        $stmt->bindParam(':ip', $ip_address);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

    } catch (PDOException $e) {
        $err = "Error: " . $e->getMessage();
    }
    $resp = ($err == '') ? 'true' : $err;
    return $resp;

};


function exportcsv($table)
{
    try {

        $db = new DbConn;

        $sql = "SELECT * FROM ".$table.";";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        $exportid = uniqid(rand(), false);
        $filename = "exportdir/".$table.'-'.date('d.m.Y').'_'.$exportid.'.csv';

        $data = fopen($filename, 'w');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($data, $row);
        }

        return $filename;

    } catch (PDOException $e) {
        $err = "Error: " . $e->getMessage();
    }
    $resp = ($err == '') ? 'true' : $err;
    return $resp;
}

