<?php
//PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();
if (!isset($_SESSION['username'])) {
    header("location:main_login.php");
    exit(0);
}

$text = "";

require(dirname(__DIR__).'/common/includes/class_user.php');
require(dirname(__DIR__) . '/common/includes/userinfo.php');

if ($user->accessdoor == 1)
    $_SESSION['access'] = 1;
else
    $_SESSION['access'] = 0;


if($_SESSION['access'] == 1)
{
    if($_SESSION['lastpage'] == "mainlogin")
    {
        require "common/includes/functions.php";
        require "includes/door.php";
        $_SESSION['lastpage'] = "index";
        $text = '<div class="alert alert-success">Information: La porte vient d\'être ouverte pour <strong> 3 secondes</strong>. </div>';
        // CODE OPEN door
        $door = new TheDoor;
        $datetimeNow = date("Y-m-d H:i:s");
        $door->LogAccessDoor($_SESSION['username'], get_client_ip(), $datetimeNow);
        $door->OpenTheDoor();
    }
}
else
{
    $text = '<div class="alert alert-warning">Information: vous n\'êtes pas autorisé à ouvrir la porte. </div>';
}


$_SESSION['lastpage'] = "index";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="common/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="common/css/main.css" rel="stylesheet" media="screen">
  </head>
  <body>
  <div class="container">
      <div class="form-signin">
          <img src="common/images/logo_home_maroon.png" class="img-responsive" alt="Logo Sunlab"/>
          <h2>Déverrouillage de l'accès du SunLab.</h2>
          <p> Le <a href="http://mysunlab.org">Sunlab</a> est le Fablab qui couvre la communauté de commune de <a href="http://www.versaillesgrandparc.fr/index.php?id=181&tx_ttnews[tt_news]=1821&cHash=d435ed61f910bf42163d46c022cc5b1b">Versailles Grand Parc</a>.<br/>
              Il est géré par l'<a href="http://hatlab.fr">association Hatlab</a> et il est situé au 185 Avenue Leclerc &agrave; Viroflay.<br/>
              Le Sunlab travaille en relation étroite avec le <a href="http://sqylab.org">Sqylab, le Fablab basé à La Verrriere</a>, juste en face de la Gare SNCF).</p>

            <?php echo $text; ?>


        <a href="main_login.php" class="btn btn-lg btn-primary btn-block">Ouvrir de nouveau</a>
        <a href="common/user_deco.php?type=soft">Se déconnecter</a> | <a href="common/user.php">Gestion</a> | <a href="lastaccess.php"> Dernières ouvertures </a>
      </div>
    </div> <!-- /container -->
  </body>
</html>
