<?php
class NewUserForm extends DbConn
{
    public function createUser($usr, $uid, $email, $pw = "", $name, $firstname, $phone, $nfccard, $authtype = "local")
    {
        try {

            $db = new DbConn;
            $tbl_members = $db->tbl_members;
            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("INSERT INTO ".$tbl_members." (id, username, password, email, `name`, firstname, phone, nfccard, authtype)
            VALUES (:id, :username, :password, :email, :name, :firstname, :phone, :nfccard, :authtype )");
            $stmt->bindParam(':id', $uid);
            $stmt->bindParam(':username', $usr);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pw);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':nfccard', $nfccard);
            $stmt->bindParam(':authtype', $authtype);
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
