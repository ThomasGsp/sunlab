<?php
require(dirname(__DIR__).'/includes/functions.php');
function checkuser($uidcard)
{
    $idcard=getnfcuser($uidcard);
    if (is_object($idcard)) {
        if ($idcard->nfccard == $uidcard) {
            $result = $idcard->username;
        } else {
            $result = null;
        }
    } else {
        $result = null;
    }
    return $result;
}
