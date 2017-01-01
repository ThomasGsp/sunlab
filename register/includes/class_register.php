<?php
class _register
{

    var $name;
    var $firstname;
    var $date;
    var $ip;
    var $username;
    var $type;
    var $regtype;

    function guest()
    {
        try {
            $db = new DbConn;
            $tbl_register_guests = $db->tbl_register_guests;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("INSERT INTO ".$tbl_register_guests." (`name`, firstname, ip, `date`, `type`)
            VALUES (:name, :firstname, :ip, :date, :type)");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':firstname', $this->firstname);
            $stmt->bindParam(':ip', $this->ip);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':type', $this->type);

            $stmt->execute();
            $err = '';
        } catch (PDOException $e) {
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


    function member()
    {
        try {
            $db = new DbConn;
            $tbl_register_members = $db->tbl_register_members;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("INSERT INTO ".$tbl_register_members." (username, ip, `date`, regtype)
            VALUES (:username, :ip, :date, :regtype)");
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':ip', $this->ip);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':regtype', $this->regtype);

            $stmt->execute();
            $err = '';
        } catch (PDOException $e) {
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