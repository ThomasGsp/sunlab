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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>USER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">
    <div class="form-signin">
        <h3> Vos informations :</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Types</th>
                <th>Valeurs</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Nom</td>
                <td><?php echo $user->name;?></td>
                <td><?php if ($user->authtype == "local") { echo'<a href="user_modif.php?c=name">Modifier</a>'; } ?></td>
            </tr>
            <tr>
                <td>Prénom</td>
                <td><?php echo $user->firstname; ?></td>
                <td><?php if ($user->authtype == "local") { echo'<a href="user_modif.php?c=firstname">Modifier</a>'; } ?></td>
            </tr>
            <tr>
                <td>Pseudo</td>
                <td><?php echo $user->username; ?></td>
                <td><?php if ($user->authtype == "local") { echo '<a href="user_modif.php?c=username">Modifier </a>'; } ?></td>
            </tr>

            <tr>
                <td>Email</td>
                <td><?php echo $user->email; ?></td>
                <td><?php if ($user->authtype == "local") { echo '<a href="user_modif.php?c=email">Modifier </a>'; } ?></td>
            </tr>
            <tr>
                <td>Téléphone</td>
                <td><?php echo $user->phone; ?></td>
                <td><a href="user_modif.php?c=phone">Modifier</a></td>
            </tr>
            <tr>
                <td>Identifiant carte NFC <br/> <a target="_blank" href="http://nfc.sunlab.org">Trouver l'ID de sa carte</a></td>
                <td><?php echo $user->nfccard; ?></td>
                <td><a href="user_modif.php?c=nfccard">Modifier</a></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>*************</td>
                <td><?php if ($user->authtype == "local") { echo '<a href="user_modif.php?c=password">Modifier </a>'; } ?></td>
            </tr>
            <tr>
                <td>Porte</td>
                <td><?php
                    if ($user->accessdoor == 1)
                        echo "Votre accès porte est validé";
                    else
                        echo "Votre accès porte n'est pas validé";
                    ?>
                </td>
                <td></td>
            </tr>

            </tbody>
        </table>
        <a href="user_deco.php?type=soft">Se déconnecter</a> | <a href="gestion_login.php">Index</a> | <a href="../index.php">Ouvrir la porte</a> | <a href="user_delete.php">Supprimer son compte</a>
    </div>
</div> <!-- /container -->
</body>
</html>

