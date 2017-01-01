<?php
function getnfcuser($nfcid)
{
try {

    $db = new DbConn;
    $tbl_members = $db->tbl_members;

    $sql = "SELECT * FROM ".$tbl_members." WHERE nfccard = '".$nfcid."' LIMIT 1;";
    $stmt = $db->conn->prepare($sql);
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


?>