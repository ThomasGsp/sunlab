<?php

class TheDoor
{

    function OpenTheDoor()
    {
        exec('bin/opendoor  > /dev/null 2>/dev/null &');
    }

    public function LogAccessDoor($username, $IP, $dateaccess)
    {
        try {

            $db = new DbConn;
            $tbl_door = $db->tbl_door;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("INSERT INTO ".$tbl_door." (username, IP, dateaccess)
                                        VALUES (:username, :IP, :dateaccess)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':dateaccess', $dateaccess);
            $stmt->bindParam(':IP', $IP);

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

    public function LastAccessDoor($numbers)
    {
        try {

            $db = new DbConn;
            $tbl_door = $db->tbl_door;
            $tbl_members = $db->tbl_members;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("SELECT ".$tbl_door.".dateaccess, ".$tbl_members.".name, ".$tbl_members.".firstname FROM ".$tbl_door.", ".$tbl_members." WHERE ".$tbl_door.".username = ".$tbl_members.".username LIMIT ".$numbers);

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

};
