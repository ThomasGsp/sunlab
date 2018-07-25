<?php
$text ="";
require(dirname(__DIR__).'/common/config.php');
if(isset($_POST["submit"])) {
    if ($_POST["submit"] == true) {
        require(dirname(__DIR__).'/nfc/includes/getid.php');
        $text = '';
        if (!empty($uidcard)){
            $text = '<div class="alert alert-success">L\'id de votre carte : ' . substr(hash('sha1', $uidcard), 0, 10). ' </div>';
        }
        else {
            $text = '<div class="alert alert-warning">Aucune carte trouvée. <br/> Si votre carte est correctement placée, elle est peut-être imcompatible avec le lecteur.</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>nfc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../common/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../common/css/main.css" rel="stylesheet" media="screen">
</head>

<body>
<div class="container">
        <form class="form-signup" id="usersignup" name="usersignup" method="post" action="#">
            <img src="../common/images/logo_home_maroon.png" class="img-responsive" alt="Logo Sunlab"/>
            <h2>NFC CARD</h2>
            <h4>
                Vous pouvez lier à votre compte Sunlab n'importe quelle carte NFC.<br/>
                Cela peut être la carte fournie par le Sunlab, mais aussi votre PassNavigo, CB ou encore la clé pour le café du bureau...
                <br/><br/>
                L'identifiant NFC qui vous sera affiché n'est pas le numéro réel de votre carte, mais une empreinte.
                <br/><br/>
                Placer votre carte sur le lecteur NFC et cliquer sur le bouton ci-dessous :
            </h4>

            <button name="submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit" value="true">OBTENIR L'ID</button>
            <?php echo $text; ?>
            <a href="<?php echo $inplace; ?>">Index</a>
        </form>

</div> <!-- /container -->
</body>
</html>
