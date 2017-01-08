<?php


require('includes/door.php');
require(dirname(__DIR__).'/register/common/config.php');
require(dirname(__DIR__).'/register/common/includes/dbconn.php');

$door = new TheDoor;
$list = $door->LastAccessDoor(3);

$html = '';
foreach ($list as $last)
{
    $html = $html.'
      <tr>
        <td>'.$last->dateaccess.'</td>
        <td>'.$last->name.'</td>
        <td>'.$last->firstname.'</td>
      </tr>
    ';
}

?>


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
        <img src="../common/images/logo_home_maroon.png" class="img-responsive" alt="Logo Sunlab"/>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date </th>
                    <th>Prénom</th>
                    <th>Nom</th>
                </tr>
            </thead>
            <tbody>
            <?php echo $html; ?>
            </tbody>
        </table>

       <a href="index.php"> Retour </a>
    </form>


</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="common/js/jquery-2.2.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="common/js/bootstrap.js"></script>
<!-- The AJAX login script -->
<script src="common/js/login.js"></script>

</body>
</html>
