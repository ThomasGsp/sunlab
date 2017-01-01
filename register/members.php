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
        <img src="common/images/logo_home_maroon.png" class="img-responsive" alt="Logo Sunlab"/>
        <h2>Vous avez déjà un compte</h2>
        <hr>
        <div id="message"></div>
        <h3>Via votre login / mot de passe</h3>

        <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Username" autofocus>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">
        <input type="hidden" name="page" id="page" value="members">
        <input type="hidden" id="common" name="common" value="common/">
        <hr>
        <h3>Via nfc</h3>
        <h4>
            Nécessite l'enregistrement préalable de votre ID nfc sur votre compte.<br/>
            Placer la carte NFC devant le lecteur et cliquer sur "S'authentifier".
        </h4>
        <hr>
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" value="true" type="submit"> S'authentifier</button>


        <a href="index.php">Index</a>
    </form>


</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="common/js/jquery-2.2.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="common/js/bootstrap.js"></script>

<script src="common/js/login.js"></script>

</body>
</html>
