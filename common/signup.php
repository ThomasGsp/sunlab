<?php
  session_start();

  if (isset($_SESSION['username'])) {
      session_start();
      session_destroy();
  }

  require(dirname(__DIR__).'/common/config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Enregistrement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
  </head>

  <body>
    <div class="container">

      <form class="form-signup" id="usersignup" name="usersignup" method="post" action="user_create.php">
        <h2 class="form-signup-heading">Enregistrement pour le déverrouillage de l'accès du SunLab.</h2>

        <?php if($mod_ldap == true) { ?>

            <h4> 1/ Vous avez la possibilité de vous enregistrer en utilisant votre compte LDAP de l'association.</h4>
           <a href="connectors/signupldap.php" class="btn btn-lg btn-primary btn-block" role="button"> Utiliser mon compte LDAP </a>

        <?php } ?>
        <hr/>
        <h4> 2/ Vous pouvez aussi vous enregistrer sur le système de façon indépendante</h4>
        <p>Pour pouvoir utiliser le dispositif d'accès du Sunlab, merci de remplir le formulaire ci dessous :</p>
          <input name="name" id="name" type="text" class="form-control" placeholder="Nom" autofocus>
          <input name="firstname" id="firstname" type="text" class="form-control" placeholder="Prénom">

          <input name="newuser" id="newuser" type="text" class="form-control" placeholder="Pseudo">
          <input name="email" id="email" type="text" class="form-control" placeholder="Email">

          <input name="phone" id="phone" type="text" class="form-control" placeholder="Téléphone(optionnel)">
          <input name="nfccard" id="nfccard" type="text" class="form-control" placeholder="ID Carte nfc(optionnel)">
          <a target="_blank" href="http://nfc.sunlab.org">Trouver l'ID de sa carte</a>
          <br />

          <input name="password1" id="password1" type="password" class="form-control" placeholder="Mot de passe">
          <input name="password2" id="password2" type="password" class="form-control" placeholder="Mot de passe vérification">

          <br />
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">S'enregistrer</button>

        <div id="message"></div>
        <a href="../index.php">Index</a>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <script src="js/signup.js"></script>

    <script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>
<script>

$( "#usersignup" ).validate({
  rules: {
	email: {
		email: true,
		required: true
	},
    phone: {
      phone: true,
      required: false
    },
    firstname: {
      firstname: true,
      required: true
    },
    name: {
      name: true,
      required: true
    },
    newuser: {
      newuser: true,
      required: true
    },
    password1: {
      required: true,
      minlength: 4
	},
    password2: {
      equalTo: "#password1"
    }
  }
});
</script>

  </body>
</html>
