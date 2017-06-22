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

if (isset($_POST["data"]))
{
  if (isset($_POST['type']))
  {
      if ($_POST['type'] == "password") {

          $result = $getinfouser->changevalue($_POST["type"], password_hash($_POST["data"], PASSWORD_DEFAULT));
      } else {
          $result = $getinfouser->changevalue($_POST["type"], $_POST["data"]);
          if ($_POST["type"] == "username") {
              header("location:user_deco.php");
              exit(0);
          }
      }
      header("location:user.php");
      exit(0);
  }
} else {
  $value = "";
  switch ($_GET['c']) {
    case "name":
      $text = "Nom:";
      $value = $user->name;
      break;
    case "firstname":
      $text = "Prénom:";
      $value = $user->firstname;
      break;
    case "username":
      $text = "Pseudo:";
      $value = $user->username;
      break;
    case "email":
      $text = "Email:";
      $value = $user->email;
      break;
    case "phone":
      $text = "Téléphone:";
      $value = $user->phone;
      break;
    case "nfccard":
      $text = "nfccard:";
      $value = $user->nfccard;
      break;
    case "password":
      $text = "Nouveau mot de passe:";
      $value = "";
      break;
    default:
      header("location: user.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>USER EDIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">
    <div class="form-signin">
        <form action="user_modif.php" method="post">
            <div class="form-group">
                <label for="datad"><?php echo $text; ?></label>
                <input class="form-control" <?php if($_GET['c'] == "password") { echo 'type="password"'; }?> name="data" id="data" value="<?php echo $value; ?>">
                <input type="hidden" name="type" id="type" value="<?php echo $_GET['c']; ?>">
            </div>
            <button type="submit" class="btn btn-default">Enregistrer</button>
        </form>
        <a href="user_deco.php?type=soft">Se déconnecter</a> | <a href="user.php">Annuler</a>
    </div>
</div> <!-- /container -->
</body>
</html>

<?php }