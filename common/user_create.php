<?php

require(dirname(__DIR__).'/common/config.php');
require(dirname(__DIR__).'/common/globalcon.php');
require(dirname(__DIR__).'/common/includes/dbconn.php');
require(dirname(__DIR__).'/common/includes/functions.php');
require(dirname(__DIR__).'/common/includes/newuserform.php');
require(dirname(__DIR__).'/common/includes/selectemail.php');
require(dirname(__DIR__).'/common/includes/mailsender.php');
//Pull username, generate new ID and hash password
$newid = uniqid(rand(), false);
$newuser = $_POST['newuser'];
$newpw = password_hash($_POST['password1'], PASSWORD_DEFAULT);
$name = $_POST['name'];
$firstname = $_POST['firstname'];
$phone = $_POST['phone'];
$nfccard = $_POST['nfccard'];
$authtype = $_POST['authtype'];


//Enables moderator verification (overrides user self-verification emails)
if (isset($admin_email)) {
    $sendemailverif = $admin_email;
    $newemail = $_POST['email'];
} else {

    $sendemailverif = $_POST['email'];
    $newemail = $_POST['email'];
}


if ($authtype != "local")
{
    $pw1 = "";
    $pw2 = "";

}
else{
    $pw1 = $_POST['password1'];
    $pw2 = $_POST['password2'];
}


//Validation rules
if (($pw1 != $pw2) && $authtype == "local")
{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Les mots de passes ne sont pas identiques</div><div id="returnVal" style="display:none;">false</div>';
} elseif (strlen($pw1) < 7 && $authtype == "local")
{
    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Mot de passe trop court, minimum 7 caractères requis</div><div id="returnVal" style="display:none;">false</div>';
} elseif (!filter_var($newemail, FILTER_VALIDATE_EMAIL) == true && $authtype == "local") {

    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Vous devez enregistrer une adresse email valide</div><div id="returnVal" style="display:none;">false</div>';

}
else {
    //Validation passed
    if (isset($_POST['newuser']) && !empty(str_replace(' ', '', $_POST['newuser'])) && (isset($_POST['password1']) && !empty(str_replace(' ', '', $_POST['password1'])) || $authtype != "local" )  ) {

        //Tries inserting into database and add response to variable

        $a = new NewUserForm;

        $response = $a->createUser($newuser, $newid, $newemail, $newpw, $name, $firstname, $phone, $nfccard, $authtype);

        //Success
        if ($response == 'true') {

            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'. $signupthanks .'</div><div id="returnVal" style="display:none;">true</div>';
            $userinfo = array(
               "user" => $newuser,
                "email" => $newemail,
                "name" => $name,
                "firstname" => $firstname,
                "authtype" => $authtype,
                "phone" => $phone
            );
            //Send verification email
            $m = new MailSender;
            $m->sendMail($sendemailverif, $newuser, $newid, 'Verify', $userinfo);
            if($authtype == "local")
                echo "<script type='text/JavaScript'> setTimeout('location.href = \"gestion_login.php\";',10000); </script> ";
            else
                echo "<script type='text/JavaScript'> setTimeout('location.href = \"../gestion_login.php\";',10000); </script> ";
        } else {
            //Failure
            mySqlErrors($response);
        }
    } else {
        //Validation error from empty form variables
        echo 'Une erreur est survenue. Essayez de nouveau ou contactez un administrateur.';
     }
}
