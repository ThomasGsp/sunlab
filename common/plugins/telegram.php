<?php
/**
 * Created by PhpStorm.
 * User: tlams
 * Date: 16/05/17
 * Time: 19:06
 */

$token = "bot388538820:AAEidUNC0BjcUHFlD9XGL4nP2oljYmMSwcw";
$chatid = "-36455667";


function sendMessage($chatID, $messaggio, $token) {
    //echo "sending message to " . $chatID . "\n";


    $url = "https://api.telegram.org/" . $token . "/sendMessage?chat_id=" . $chatID;
    $url = $url . "&text=" . urlencode($messaggio);
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

