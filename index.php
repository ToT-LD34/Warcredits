<?php
session_start();
include('db.php');
include('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warcredits</title>
    <link rel="stylesheet" href="css/master.css">
</head>

<body>
    <header>
        <h1>WARCREDITS</h1>
        <h2>Un jeu où tu te bat pour du fric de banquier pour te battre plus encore !</h2>
    </header>

    <div class="flexbox">
        <aside>
            <div class="connexion">
                <h3>Connexion</h3>
                <?php include('templates/login.php'); ?>
            </div>
            <div class="inscription">
                <h3>Inscription</h3>
                <?php include('templates/createuser.php'); ?>
            </div>
            <div class="user-list">
                <h3>Utilisateurs enregistrés</h3>
                <ul>
                    <?php readUser($db); ?>
                </ul>
            </div>
        </aside>
        <section>
            <h3>Ici, la présentation du jeu</h3>
            <div class="illustration"></div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </section>
    </div>

    <footer>
        <p>Warcredits est un jeu de stratégie fun est "convivial" qui vous est proposé gratuitement par Watilin et Megaju.</p>
    </footer>
</body>
</html>
