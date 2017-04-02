<?php
//Set this for global site use
$site_name = 'Sunlab';

//Maximum Login Attempts
$max_attempts = 15;
//Timeout (in seconds) after max attempts are reached
$login_timeout = 10;

$nfc_url = "http://nfc.sunlab.org";
$inplace = "http://presence.mysunlab.org";

// Authentification module
$mod_ldap = true;

//ONLY set this if you want a moderator to verify users and not the users themselves, otherwise leave blank or comment out
$admin_email = 'mail@demo.fr';

//EMAIL SETTINGS
//SEND TEST EMAILS THROUGH FORM TO https://www.mail-tester.com GENERATED ADDRESS FOR SPAM SCORE
$from_email = 'mail@demo.fr'; //Webmaster email
$from_name = 'Sunlab'; //"From name" displayed on email

//Find specific server settings at https://www.arclab.com/en/kb/email/list-of-smtp-and-pop3-servers-mailserver-list.html
$mailServerType = 'smtp';
//IF $mailServerType = 'smtp'
$smtp_server = 'localhost';
$smtp_user = '';
$smtp_pw = '';
$smtp_port = 25; //465 for ssl, 587 for tls, 25 for other
$smtp_security = '';//ssl, tls or ''

//HTML Messages shown before URL in emails (the more
$verifymsg = 'Un membre vient d\'enregistrer ses accès porte. Le lien de validation est: '; //Verify email message
$doormsg = 'La validation du compte n\'autorise pas l\'accès à la porte du Sunlab, pour l\'activer:' ; //Verify email message
$active_email = 'Votre compte d\'accès au Sunlab est maintenant actif !';//Active email message
$active_door = 'Vous pouvez maintenant ouvrir la porte du Sunlab !';//Active email message
//LOGIN FORM RESPONSE MESSAGES/ERRORS
$signupthanks = 'Merci pour votre enregistrement, un administrateur validera votre compte prochainement. <br /> Redirection sur la page de login dans quelques secondes...';
$activemsg = 'Le compte est validé !';

//DO NOT TOUCH BELOW THIS LINE
//Unsets $admin_email based on various conditions (left blank, not valid email, etc)
if (trim($admin_email, ' ') == '') {
    unset($admin_email);
} elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL) == true) {
    unset($admin_email);
    echo $invalid_mod;
};
$invalid_mod = '$adminemail is not a valid email address';

//Makes readable version of timeout (in minutes). Do not change.
$timeout_minutes = round(($login_timeout / 60), 1);
