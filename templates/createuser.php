<?php
// ADD USER
if (isset($_SESSION['alert']) || isset($_SESSION['erreur'])){
    errors();
}
else
{
    if(isset($_POST['forminscription']))// If informations ok
    {
        createUser($db);
    }
}
?>

<form action="" method="post">

    <input type="text" placeholder="Votre nom" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; } ?>">

    <input type="text" placeholder="Votre planète" name="planet" value="<?php if(isset($_SESSION['planet'])) { echo $_SESSION['planet']; } ?>">

    <input type="password" placeholder="Votre mot de passe" name="pwd">

    <input type="password" placeholder="Confirmez votre mot de passe" name="pwd2">

    <input type="submit" name="forminscription" value="Envoyer">

</form>
