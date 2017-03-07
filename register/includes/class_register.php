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

    function listdaymembers()
    {

        try {

            $db = new DbConn;
            $tbl_register_members = $db->tbl_register_members;
            $tbl_register_guests = $db->tbl_register_guests;
            $datefilter = date("Y-m-d").'%';

            $sql = "
            SELECT `name`, firstname, `date` FROM ".$tbl_register_guests." WHERE `date` LIKE :dates
            UNION ALL
            SELECT members.name AS `name`, members.firstname AS `firstname`, register_members.date AS `date` 
            FROM members, register_members WHERE register_members.username = members.username and register_members.date LIKE :dates ";
            $stmt = $db->conn->prepare($sql);
            $stmt->bindParam(':dates', $datefilter);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $result;

        } catch (PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }
        $resp = ($err == '') ? 'true' : $err;
        return $resp;
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