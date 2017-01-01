<?php

class TheDoor
{
    function OpenTheDoor()
    {
        exec('bin/opendoor');
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
};
