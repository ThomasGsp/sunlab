<?php

if(isset($_POST["action"]))
{
    if ($_POST['action'] == 'member') {
        header("location:members.php");
        exit(0);
    } else if ($_POST['action'] == 'memberext') {
        header("location:common/signup.php");
        exit(0);
    } else if ($_POST['action'] == 'guest') {
        header("location:guest.php");
        exit(0);
    }
}

require(dirname(__DIR__).'/register/common/config.php');
require(dirname(__DIR__).'/register/common/includes/dbconn.php');
require(dirname(__DIR__).'/register/common/includes/functions.php');
require(dirname(__DIR__).'/register/includes/class_register.php');

$listregister = new _register();
$menbersregister = $listregister->listdaymembers();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Présence</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="common/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="common/css/main.css" rel="stylesheet" media="screen">

    <script type="application/javascript">
        function afficher_cacher(id)
        {
            if(document.getElementById(id).style.visibility=="hidden")
            {
                document.getElementById(id).style.visibility="visible";
                document.getElementById('bouton_'+id).innerHTML='>> Cacher la liste des inscrits du jour << ';
            }
            else
            {
                document.getElementById(id).style.visibility="hidden";
                document.getElementById('bouton_'+id).innerHTML='>> Afficher la liste des inscrits du jour <<';
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container">
    <form class="form-signup" id="usersignup" name="usersignup" method="post" action="#">
        <a href="/" ><img src="common/images/logo_home_maroon.png" class="img-responsive" alt="Logo Sunlab"/></a>
        <h2>Formulaire de présence</h2>
        <p>
            <h3>Ce formulaire permet d'enregistrer électroniquement sa présence dans le local du Sunlab.</h3>
            <h4>    - Si vous êtes membre et que vous avez déjà un compte vous pouvez utiliser celui-ci pour vous identifier <br />
                    - Si vous êtes membre et que vous n'avez pas de compte vous pouvez le créer <br />
                    - Si vous êtes visiteur ou membre sans compte, veuillez remplir le formulaire.</h4>
        </p>

        <button name="action" value="member" class="btn btn-primary btn-lg btn-block" type="submit" >Je suis membre avec un compte.</button>
        <button name="action" value="memberext" class="btn btn-primary btn-lg btn-block" type="submit" >Je suis membre sans compte et souhaite en créer un.</button>
        <button name="action" value="guest" class="btn btn-default btn-lg btn-block" type="submit">Je suis visiteur ou membre sans compte.</button>
    </form>


    <span class="bouton" id="bouton_tableaumembresinscripts" onclick="afficher_cacher('tableaumembresinscripts');"> >> Afficher la liste des inscrits du jour << </span>
    <div id="tableaumembresinscripts">
        <table  id="membergestion" class="table table-bordered">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date</th>
            </thead>
            <tbody>

            <?php
            foreach ($menbersregister as $member)
            {
                echo '<tr><td>' .$member->name. '</td><td>' .$member->firstname. '</td> <td>' .$member->date. '</td> </tr>';
            }

            ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        //<!--
        afficher_cacher('tableaumembresinscripts');
        //-->
    </script>
</div> <!-- /container -->
</body>
</html>
