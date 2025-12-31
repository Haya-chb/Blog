<?php
session_start();
include ('../connexion.php');
include ('../controleur/c-billet.php');

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/archives-style.css">
    <title>Archives</title>
</head>
<body>



<?php
echo'<nav>
<a href="../index.php">Acceuil</a>
<a href="archives.php">Archives</a>';

if (isset($_SESSION['id_utilisateur']) && !empty($_SESSION['proprietaire']) && $_SESSION['proprietaire'] == 1) {
echo'<a href="admin.php?admin=Articles">Administrateur</a>';
}

if (isset($_SESSION['id_utilisateur'])){

     echo '<form action="../deconnexion.php" method="post">
            <input type="submit" value="Déconnexion">
            </form>';
}

echo'</nav><main>';



foreach ($result as $row){

echo '<br><br>';
echo '<a href= article.php?id='.$row["id_billet"].'> <strong>'.$row["titre"].'</strong> </a>';
echo'<br>';
echo $row["date"];
echo '<br>';
echo $row["contenu"];


}

?>




</main>
</body>
</html>