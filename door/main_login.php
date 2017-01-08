<?php
session_start();
if (isset($_SESSION['username'])) {
    $_SESSION['lastpage'] = "mainlogin";
    header("location:index.php");
    exit(0);
}
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
      <form class="form-signin" name="form1" method="post" action="">
        <img src="../common/images/logo_home_maroon.png" class="img-responsive" alt="Logo Sunlab"/>
        <h2>Déverrouillage de l'acces du SunLab.</h2>
        <p> Le <a href="http://mysunlab.org">Sunlab</a> est le Fablab qui couvre la communauté de commune de <a href="http://www.versaillesgrandparc.fr/index.php?id=181&tx_ttnews[tt_news]=1821&cHash=d435ed61f910bf42163d46c022cc5b1b">Versailles Grand Parc</a>.<br/>
          Il est géré par l'<a href="http://hatlab.fr">association Hatlab</a> et il est situé au 185 Avenue Leclerc &agrave; Viroflay.<br/>
          Le Sunlab travaille en relation étroite avec le <a href="http://sqylab.org">Sqylab, le Fablab basé à La Verrriere</a>, juste en face de la Gare SNCF).</p>

        <p>Si vous souhaitez accéder au Sunlab et déverrouiller la porte principale, merci de donner vos codes d'accès:<br/></p>

        <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Username" autofocus>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">
        <input type="hidden" id="page" name="page" value="door">
        <input type="hidden" id="common" name="common" value="common/">
        <!-- The checkbox remember me is not implemented yet...
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">OUVRIR LA POSTE</button>

        <div id="message"></div>
        <a href="common/signup.php">S'enregistrer</a> | <a href="common/user.php">Gestion</a> | <a href="lastaccess.php"> Dernières ouvertures </a>
      </form>


    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="common/js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="common/js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="common/js/login.js"></script>

  </body>
</html>
