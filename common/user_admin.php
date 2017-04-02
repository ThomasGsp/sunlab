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

if ($user->admin != 1)
{
    header("location:user_member.php");
    exit(0);
}

$userlist = getallusers();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ADMIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link href="css/jquery.dataTables.min.css" rel="stylesheet" media="screen">
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script type="application/javascript">
        /*

        */

        $(function(){
            $(document).ready(function(){
                $('#membergestion').DataTable();
            });
            $('.valid').click(function(){
                var elem = $(this);
                $("#message").html("<img src='images/ajax-loader.gif'> Action en cours ... ");
                $.ajax({
                    type: "GET",
                    url: "user_verify.php",
                    data: "uid="+elem.attr('data-id')+"&v="+elem.attr('data-type'),
                    dataType:"html",
                    success: function() {
                        location.reload();
                    }
                });
                return false;
            });


            $('.reset').click(function(){
                var elem = $(this);
                $("#message").html(".<img src='images/ajax-loader.gif'> Reset en cours ..");
                $.ajax({
                    type: "GET",
                    url: "include/resetpw.php",
                    data: "username="+elem.attr('data-username'),
                    dataType:"html",
                    success: function() {
                        location.reload();
                    }
                });
                return false;
            });


            $('.export').click(function(){
                var elem = $(this);
                $("#message").html(".<img src='images/ajax-loader.gif'> Export en cours ...");
                $.ajax({
                    type: "GET",
                    url: "exportdata.php",
                    data: "table="+elem.attr('data-base'),
                    dataType : 'html',
                    success: function (html) {
                            $("#message").html("<div class=\"alert alert-info\"> "+ html + "</div>");
                        }
                });
                return false;
            });

            $('.validdoor').click(function(){
                var elem = $(this);
                $("#message").html("<img src='images/ajax-loader.gif'> Action en cours ... ");
                $.ajax({
                    type: "GET",
                    url: "../door_validation.php",
                    data: "uid="+elem.attr('data-id')+"&v="+elem.attr('data-type'),
                    dataType:"html",
                    success: function() {
                        location.reload();
                    }
                });
                return false;
            });
        });
    </script>
</head>
<body>
<div class="container">
    <div class="form-signin">

        <h3>Vos informations administrateur:</h3>
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
                <td>Identifiant carte NFC <br/> <a target="_blank" href="<?php echo $nfc_url; ?>">Trouver l'ID de sa carte</a></td>
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

        <h3> Gestion des membres:</h3>
        <table  id="membergestion" class="table table-bordered">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>NFC</th>
                <th>Password</th>
                <th>Compte</th>
                <th>Porte</th>
            </tr>
            </thead>
            <tbody>

            <?php
            foreach ($userlist as $usermenber)
            {
                $getinfousermember = new _user_informations();
                $getinfousermember->username = $usermenber->username;
                $userinfo = $getinfousermember->getuserinfo();
            ?>
                <tr>
                    <td><?php echo $userinfo->name;?></td>
                    <td><?php echo $userinfo->firstname; ?></td>
                    <td><?php echo $userinfo->username; ?></td>
                    <td><?php echo $userinfo->email; ?></td>
                    <td><?php echo $userinfo->phone; ?></td>
                    <td><?php echo $userinfo->nfccard; ?></td>
                    <td> <?php echo '<a  href="#" class="reset" data-username="'.$userinfo->username.'">Reset</a>'; ?> </td>
                    <td><?php
                        if ($userinfo->verified == 1)
                            echo '<a href="#" class="valid" data-type=0 data-id="'.$userinfo->id.'">Invalider</a>';
                        else
                            echo '<a href="#" class="valid" data-type=1 data-id="'.$userinfo->id.'">Valider</a>';
                        ?>
                    </td>
                    <td><?php
                        if ($userinfo->accessdoor == 1)
                            echo '<a href="#" class="validdoor" data-type=0 data-id="'.$userinfo->id.'">Invalider</a>';
                        else
                            echo '<a href="#" class="validdoor" data-type=1 data-id="'.$userinfo->id.'">Valider</a>';
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
        <div id="">
            Téléchargements:
            <a href="#" class="export" data-type=1 data-base="register_guests">Données visiteurs</a> | <a href="#" class="export" data-type=1 data-base="register_members">Données membres</a> | <a href="#" class="export" data-type=1 data-base="door">Logs ouverture de porte</a>
        </div>
        <div id="message"></div>

        <br><br>
        <a href="user_deco.php?type=soft">Se déconnecter</a> | <a href="../index.php">Ouvrir la porte</a> | <a href="user_delete.php">Supprimer son compte</a>
    </div>
</div> <!-- /container -->
</body>
</html>