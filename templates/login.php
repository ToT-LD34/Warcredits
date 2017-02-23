<?php
if(isset($_POST['formconnect']))
{
    $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
    $pwdconnect = sha1($_POST['pwdconnect']);
    if(!empty($pseudoconnect) AND !empty($pwdconnect))
    {
        $requser = $db->prepare("SELECT * FROM user WHERE pseudo = ?AND pwd = ?");
        $requser->execute(array($pseudoconnect, $pwdconnect));
        $userexist = $requser->rowCount();
        if ($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION["id"] = $userinfo["id"];
            $_SESSION["pseudo"] = $userinfo["pseudo"];
            $_SESSION["mail"] = $userinfo["mail"];
            $_SESSION["isconnect"] = $_POST["isconnect"];
            header("Location: admin.php?id=".$_SESSION['id']);
        }
        else
        {
            $erreur = "Mauvais identifiants !";
        }
    }
    else
    {
        $erreur = "Tout les champs doivent être complétés !";
    }
}
?>

<form action="" method="post">

    <input type="text" name="pseudoconnect" placeholder="Votre pseudo" class="form-control">

    <input type="password" name="pwdconnect" placeholder="Votre mot de passe" class="form-control">

    <input type="submit" name="formconnect" value="Se connecter" class="btn btn-success center-block">

    <input type="hidden" value="1" name="isconnect">

</form>
