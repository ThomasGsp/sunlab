<?php
//PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();
if (!isset($_SESSION['username'])) {
    header("location:gestion_login.php");
    exit(0);
}

require(dirname(__DIR__).'/common/config.php');
require(dirname(__DIR__).'/common/includes/functions.php');
require(dirname(__DIR__).'/common/includes/class_user.php');
require(dirname(__DIR__).'/common/includes/userinfo.php');

if (isset($_POST["delete"]))
{
    if ($_POST["delete"] ==  "true") {
        $user->deleteaccount();
        session_destroy();
        header("location:../index.php");
        exit(0);
    }
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
    <div class="form-signin">
        <form action="user_delete.php" method="post">
            <div class="form-group">
                <div class="checkbox disabled">
                    <label><input type="checkbox" name="delete" value="true">Je confirmer vouloir supprimer mes accès.</label>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Valider</button>
        </form>
        <a href="user_deco.php">Se déconnecter</a> | <a href="user.php">Annuler</a>
    </div>
</div> <!-- /container -->
</body>
</html>

