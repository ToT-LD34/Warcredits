<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Warcredits</title>
  <link rel="stylesheet" href="css/master.css">
</head>
<!-- connect to db -->
<?php include('db.php'); ?>
<?php include('functions.php'); ?>
<body>
  <header>
    <h1>WARCREDITS</h1>
    <h2>Un jeu où tu te bat pour du fric de banquier pour te battre plus encore !</h2>
  </header>

  <section>
    <div class="inscription">
      <h3>Inscription</h3>
      <?php include('templates/createuser.php'); ?>
    </div>
    <div class="intro">
    <!-- users list -->
    <h3>Utilisateurs enregistrés</h3>
    <ul>
      <?php
      $users = $db->query('SELECT users.id AS userid, users.name AS name, planets.users_id, planets.name AS planet FROM users INNER JOIN planets ON planets.users_id = users.id');
      while ($user = $users->fetch()) {
        echo '<li><i class="name">'.$user['name'].'</i> empereur de la planète '.$user['planet'].' !!!</li>';
      }
      ?>
    </ul>
    </div>
  </section>

  <footer>
    <p>Warcredits est un jeu de stratégie fun est "convivial" qui vous est proposé gratuitement par Watilin et Megaju.</p>
  </footer>
</body>
</html>
