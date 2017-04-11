<?php
class MailSender
{
    var $newpw;

    public function sendMail($email, $user, $id='', $type, $userinfo="")
    {

        require(dirname(__DIR__).'/scripts/PHPMailer/PHPMailerAutoload.php');
        require(dirname(__DIR__).'/config.php');
        require(dirname(__DIR__).'/globalcon.php');
        $finishedtext = $active_email;

        // ADD $_SERVER['SERVER_PORT'] TO $verifyurl STRING AFTER $_SERVER['SERVER_NAME'] FOR DEV URLS USING PORTS OTHER THAN 80
        // substr() trims "user_create.php" off of the current URL and replaces with verifyuser.php
        // Can pass 1 (verified) or 0 (unverified/blocked) into url for "v" parameter
        $verifyurl = $base_url . "/common/user_verify.php?v=1&uid=" . $id;
        $verifyporteurl = $base_url. "/common/door_validation.php?v=1&uid=" . $id;

        // Create a new PHPMailer object
        // ADD sendmail_path = "env -i /usr/sbin/sendmail -t -i" to php.ini on UNIX servers
        $mail = new PHPMailer;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 80;
        $mail->setFrom($from_email, $from_name);
        $mail->AddReplyTo($from_email, $from_name);
        /****
        * Set who the message is to be sent to
        * CAN BE SET TO addAddress(youremail@website.com, 'Your Name') FOR PRIVATE USER APPROVAL BY MODERATOR
        * SET TO addAddress($email, $user) FOR USER SELF-VERIFICATION
        *****/
        $mail->addAddress($email, $user);

        //Sets message body content based on type (verification or confirmation)
        if ($type == 'Verify') {

            //Set the subject line
            $mail->Subject = $user . ' -- Compte Sunlab';

            //Set the body of the message
            $mail->Body = $verifymsg .'<br/>
                <a href="'.$verifyurl.'">'.$verifyurl.'</a>'."<br/>".
                "----------------------------"."<br/>".
                "Nom:" .$userinfo["name"]."<br/>".
                "Prénom:" .$userinfo["firstname"]."<br/>".
                "Pseudo:" .$userinfo["user"]."<br/>".
                "Tél:" .$userinfo["phone"]."<br/>".
                "email:" .$userinfo["email"]."<br/>".
                "Type d'authentification:" .$userinfo["authtype"]."<br/>".
                "----------------------------"."<br/>".
                $doormsg .'<br/>'.
                '<a href="'.$verifyporteurl.'">'.$verifyporteurl.'</a>'."<br/>";

            $mail->AltBody  =  $verifymsg . $verifyurl;

        }
        elseif ($type == 'mailuser') {

            //Set the subject line
            $mail->Subject = $user . ' -- Compte Sunlab';

            //Set the body of the message
            $mail->Body =
                "Bonjour, nous avons bien enregistré votre compte avec les informations suivantes:".
                "----------------------------"."<br/>".
                "Nom:" .$userinfo["name"]."<br/>".
                "Prénom:" .$userinfo["firstname"]."<br/>".
                "Pseudo:" .$userinfo["user"]."<br/>".
                "Tél:" .$userinfo["phone"]."<br/>".
                "email:" .$userinfo["email"]."<br/>".
                "Type d'authentification:" .$userinfo["authtype"]."<br/>".
                "----------------------------"."<br/>".
                "Un administrateur procèdera prochainement à son activation.".
                "".
                "Le SUNLAB.";

            $mail->AltBody  =  "Bonjour, nous avons bien enregistré votre compte, un administrateur procèdera prochainement à son activation.";
        }
        elseif ($type == 'Active') {

            //Set the subject line
            $mail->Subject = $site_name . ' Compte validé!';

            //Set the body of the message
            $mail->Body = $active_email . '<br><a href="'.$signin_url.'">'.$signin_url.'</a>';
            $mail->AltBody  =  $active_email . $signin_url;

        }
        elseif ($type == 'door') {

            //Set the subject line
            $mail->Subject = $site_name . ' Accès au sunlab validé!';

            //Set the body of the message
            $mail->Body = $active_door . '<br><a href="'.$signin_url.'">'.$signin_url.'</a>';
            $mail->AltBody  =  $active_door . $signin_url;

        }
        elseif ($type == 'resetpw') {

            //Set the subject line
            $mail->Subject = $site_name . ' Votre mot de passe Sunlab';

            //Set the body of the message
            $mail->Body = "Votre nouveau mot de passe est le suivant:".$this->newpw."\n Nous vous conseillons de le changer via les paramètres de votre compte";
            $mail->AltBody  =  "Votre nouveau mot de passe est le suivant:".$this->newpw;
        }

        //SMTP Settings
        if ($mailServerType == 'smtp') {

            $mail->IsSMTP(); //Enable SMTP
            $mail->SMTPAuth = true; //SMTP Authentication
            $mail->Host = $smtp_server; //SMTP Host
            //Defaults: Non-Encrypted = 25, SSL = 465, TLS = 587
            $mail->SMTPSecure = $smtp_security; // Sets the prefix to the server
            $mail->Port = $smtp_port; //SMTP Port
            //SMTP user auth
            $mail->Username = $smtp_user; //SMTP Username
            $mail->Password = $smtp_pw; //SMTP Password
            //********************
            $mail->SMTPDebug = 0; //Set to 0 to disable debugging (for production)

        }

        try {

            $mail->Send();

        } catch (phpmailerException $e) {

            echo $e->errorMessage();// Error messages from PHPMailer

        } catch (Exception $e) {

            echo $e->getMessage();// Something else

        }
    }
}
