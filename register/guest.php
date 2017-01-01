<?php
require(dirname(__DIR__).'/register/common/config.php');
require(dirname(__DIR__).'/register/common/includes/dbconn.php');
require(dirname(__DIR__).'/register/common/includes/functions.php');
require(dirname(__DIR__).'/register/includes/class_register.php');

$message = "";

if(isset($_POST["submit"]))
{
    if ($_POST["submit"] == true)
    {
        if (!empty($_POST["name"]) && !empty($_POST["firstname"]))
        {
            if(isset($_POST["checkbox"]))
            {
                $guest = new _register();
                $guest->name = $_POST["name"];
                $guest->firstname = $_POST["firstname"];
                $guest->ip = get_client_ip();
                $datetimeNow = date("Y-m-d H:i:s");
                $guest->date = $datetimeNow;
                $guest->type = $_POST["radio"];
                $guest->guest();
                $message = '<div class="alert alert-info">Vous êtes bien enregistré pour cette séance ! Merci.</strong>
                          <script type=\'text/JavaScript\'> setTimeout(\'location.href = "index.php";\',  7000); </script>
                          </div>';
            }
            else
            {
                $message = '<div class="alert alert-warning">Conditions non acceptés</strong></div>';
            }
        }
        else
        {
            $message = '<div class="alert alert-warning">Champ non ou prénom invalide.</strong></div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Présence</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../common/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../common/css/main.css" rel="stylesheet" media="screen">
    <link href="../common/css/checkbox.css" rel="stylesheet" media="screen">
    <link href="../common/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <form class="form-signup" id="usersignup" name="usersignup" method="post" action="#">
        <div class="message"><?php echo $message;?></div>
        <img src="../common/images/logo_home_maroon.png" class="img-responsive" alt="Logo Sunlab"/>
        <h2>Formulaire de présence</h2>
        <p>
            <h3>Ce formulaire permet d'enregistrer électroniquement sa présence dans le local du Sunlab.</h3>
            <h4> Vous êtes visiteur ou membre sans compte, veuillez remplir le formulaire.</h4>
        </p>

        <input name="name" id="name" type="text" class="form-control" placeholder="Nom" autofocus>
        <input name="firstname" id="firstname" type="text" class="form-control" placeholder="Prénom">
        <div class="funkyradio">
            <div class="funkyradio-success">
                <input type="checkbox" name="checkbox" id="checkbox3"/>
                <label for="checkbox3">J'accepte les conditions et le réglement régissant le Sunlab</label>
            </div>
        </div>
        <div class="funkyradio">
            <div class="funkyradio-primary">
                <input type="radio" name="radio" id="radio1" value="guest" checked/>
                <label for="radio1">Je suis visiteur</label>
            </div>
            <div class="funkyradio-primary">
                <input type="radio" name="radio" id="radio2" value="member"/>
                <label for="radio2">Je suis membre sans compte</label>
            </div>
        </div>

        <input type="hidden" name="page" value="guest">
        <br/>
        <button name="submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit" value="true"> Valider </button>

        <div class="message"><?php echo $message;?></div>
        <a href="index.php">Index</a> | <a style="float: right" href="http://hatlab.fr/rsc/hatlab_reglementInterieur.pdf" target="_blank">Réglement</a>
    </form>
</div> <!-- /container -->
</body>
</html>
