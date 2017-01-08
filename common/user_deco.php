<?php

//PUT THIS HEADER ON TOP OF EACH UNIQUE PAGE
session_start();
if (!isset($_SESSION['username'])) {
    header("location:gestion_login.php");
    exit(0);
}

session_destroy();
$txtdefault = "Merci pour votre visite !";

if (isset($_GET['type']))
{
    if ($_GET['type'] == "soft")
        $text =$txtdefault;
    else
    {
        $text = "Le changement de pseudo oblige une reconnection. \n
                 Veuillez-vous reconnecter pour continuer la gestion de votre compte.";
    }
}
else
{
    $text =$txtdefault;
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
        <?php echo $text; ?>
        <br/>
        <a href="../main_login.php">Retour à l'index</a>
    </div>
</div> <!-- /container -->
</body>
</html>

