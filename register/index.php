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

        <button name="action" value="member" class="btn btn-primary btn-lg btn-block" type="submit">Je suis membre avec un compte.</button>
        <button name="action" value="memberext" class="btn btn-primary btn-lg btn-block" type="submit">Je suis membre sans compte et souhaite en créer un.</button>
        <button name="action" value="guest" class="btn btn-default btn-lg btn-block" type="submit">Je suis visiteur ou membre sans compte.</button>
    </form>

    <h2> Statistiques </h2>

    Inscrits du jour: <br/>


</div> <!-- /container -->
</body>
</html>
