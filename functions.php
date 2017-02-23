<?php
/* =======================================================
    MESSAGE D'ERREUR ET DE CONFIRMATION
   ======================================================= */
function errors() {
    if(isset($_SESSION['erreur']))
    {
        echo '<p class="error">' . $_SESSION['erreur'] . '</p>';
    }
    if (isset($_SESSION['alert']))
    {
        echo '<p class="alert">' . $_SESSION['alert'] . '</p>';
    }
    session_destroy();
}

// CREATION D'UN USER
function createUser($db) {
    global $name, $pwd, $pwd2;
    $name_svg = htmlspecialchars($_POST['name']);
    $name = $name_svg;
    $rand = rand(1000,9999);
    $name = $name . '.' . $rand;
    $planet = $_POST['planet'];
    $pwd = sha1($_POST['pwd']);
    $pwd2 = sha1($_POST['pwd2']);
    $_SESSION['name'] = $name_svg;
    $_SESSION['planet'] = $planet;
    if(!empty($_POST['name']) AND !empty($_POST['pwd']) AND !empty($_POST['pwd2']))
    {
        $namelength = strlen($name);
        if($namelength <= 15)
        {
            if($pwd == $pwd2)
            {
                $insertmbr = $db->prepare("INSERT INTO users (name, pwd) VALUES(?, ?)");
                $insertmbr->execute(array($name, $pwd));
                $name = NULL; $pwd = NULL; $pwd2 = NULL;
                $_SESSION['alert'] = 'Votre compte a bien été créé !';
                unset($_SESSION['name']);
                unset($_SESSION['planet']);
            }
            else
            {
                $name = $name_svg;
                $_SESSION['erreur'] = "Vos mots de passe ne correspondent pas.";
            }
        }
        else
        {
            $name = $name_svg;
            $_SESSION['erreur'] = "Votre pseudo ne doit pas dépasser 15 caractères.";
        }
    }
    else
    {
        $name = $name_svg;
        $_SESSION['erreur'] = "Tout les champs doivent être complétés.";
    }
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
