<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Enregistrement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">

  </head>

  <body>
    <div class="container">

      <form  class="form-signup" id="usersignupldap" name="usersignupldap" method="post">
        <h2 class="form-signup-heading"> Etape 1: Vous identifier </h2>
        Vous avez la possibiliter de vous enregistrer en utilisant le compte LDAP de l'association.
        Cela permet d'utiliser les différents services dédiés au sunlab en ayant une authentification unique.

        <input id="usernameldap"  class="form-control" placeholder="Username" type="text" name="usernameldap" autofocus />
        <input id="passwordldap"  class="form-control" placeholder="Password" type="password" name="passwordldap" />
        <br />
        <button name="submitldap" id="submitldap" class="btn btn-lg btn-primary btn-block" type="submit">S'identifier</button>

        <br />
        <div id="messageldap"></div>
      </form>
      <br />
      <br />
      <form class="form-signup" id="usersignup" name="usersignup" method="post" action="">
        <h2 class="form-signup-heading">Etape 2: Enregistrement pour le déverrouillage de l'accès du SunLab.</h2>

        <p>Pour pouvoir utiliser le dispositif d'accès du Sunlab, merci de remplir le formulaire ci dessous :</p>
          <input name="name" id="name" type="text" class="form-control" placeholder="Nom" disabled="disabled">
          <input name="firstname" id="firstname" type="text" class="form-control" placeholder="Prénom" disabled="disabled">

          <input name="newuser" id="newuser" type="text" class="form-control" placeholder="Pseudo" disabled="disabled">
          <input name="email" id="email" type="text" class="form-control" placeholder="Email" disabled="disabled">

          <input name="phone" id="phone" type="text" class="form-control" placeholder="Téléphone(optionnel)">
          <input name="nfccard" id="nfccard" type="text" class="form-control" placeholder="ID Carte nfc(optionnel)">
          <a target="_blank" href="http://nfc.sunlab.org">Trouver l'ID de sa carte</a>
          <br />

          <br />
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" disabled="disabled" type="submit">S'enregistrer</button>

        <div id="message"></div>
        <a href="../../index.php">Index</a>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="../js/bootstrap.js"></script>

    <script src="signupldap.js"></script>

    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/additional-methods.min.js"></script>

  </body>
</html>
