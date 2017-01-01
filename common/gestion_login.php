<?php

//PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();
if (isset($_SESSION['username'])) {
    header("location:user.php");
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
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
</head>

<body>
<div class="container">
    <form class="form-signin" name="form1" method="post" action="">
        <img src="images/logo_home_maroon.png" class="img-responsive" alt="Logo Sunlab"/>
        <h2>Accès à la page de gestion de votre compte</h2>

        <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Username" autofocus>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">
        <input type="hidden" id="page" name="page" value="gestion">
        <input type="hidden" id="common" name="common" value="">

        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">SE CONNECTER</button>

        <div id="message"></div>
        <a href="signup.php">S'enregistrer</a> | <a href="../index.php">Ouvrir la porte</a>
    </form>


</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-2.2.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- The AJAX login script -->
<script src="js/login.js"></script>

</body>
</html>
