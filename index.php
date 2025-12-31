<?php
session_start();
include('controleur/c-utilisateurs.php');


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Acceuil</title>
</head>
<body>

<section>

<?php

echo'<nav>';

echo'<a href="index.php">Acceuil</a>';
echo'<a href="vue/archives.php">Archives</a>';

if (isset($_SESSION['id_utilisateur']) && !empty($_SESSION['proprietaire']) && $_SESSION['proprietaire'] == 1) {
echo'<a href="vue/admin.php?admin=Articles">Administrateur</a>';
}

if (!isset($_SESSION['id_utilisateur'])) {

echo'<form action="index.php" method="get">';
echo'<input type="submit" value="Connexion" name="connexion">';
echo'<input type="submit" value="Inscription" name="inscription">';
echo'</form></nav><main>';



if (isset($_GET['connexion']) && $_GET['connexion'] === 'Connexion') {

    echo '<section><form action="index.php" method="POST">';
echo '<p><label for="login">Login :</label><br>';
echo '<input type="text" id="login" name="login"></p>';
echo '<p><label for="pswd">Mot de passe :</label><br>';
echo '<input type="password" id="pswd" name="pswd"></p>';
echo '<input type="submit" name="valider_connexion" value="Connexion">';
echo '</form></section>';

}


elseif (isset($_GET['inscription']) && $_GET['inscription'] === 'Inscription') {

    echo '<section><form action="index.php" method="POST" enctype="multipart/form-data">';
    echo '<p><label for="login">Login :</label>';
    echo '<br><input type="text" name="login" id="login" required></p>';
    echo '<p><label for="pswd">Mot de passe :</label>';
    echo '<br><input type="password" name="pswd" id="pswd" required></p>';
    echo '<p><label for="photo">Photo de profil :</label>';
    echo '<br><input type="file" name="file" id="photo"></p>';
    echo '<input type="submit" name="valider_inscription" value="S\'inscrire">';
    echo '</form></section>';
}

}

else {
    echo '<form action="deconnexion.php" method="post">';
            echo '<input type="submit" value="Déconnexion">';
            echo '</form></nav><main>';
   
}

echo'<section>';


foreach ($limite as $row) {
    echo '<br><br>';
    echo '<a href="vue/article.php?id=' . $row["id_billet"] . '"><strong>' . $row["titre"] . '</strong></a><br>';
    echo $row["date"] . '<br>';
    
}


?>
</section>
</main>
</body>
</html>
