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
    <title>Archives</title>
</head>
<body>



<?php



echo'<nav>';

echo'<a href="../index.php">Acceuil</a>';
echo'<a href="archives.php">Archives</a>';

if (isset($_SESSION['id_utilisateur']) && !empty($_SESSION['proprietaire']) && $_SESSION['proprietaire'] == 1) {
echo'<a href="admin.php">Administrateur</a>';
}

echo'</nav>';



foreach ($result as $row){

echo '<br><br>';
echo '<a href= article.php?id='.$row["id_billet"].'> <strong>'.$row["titre"].'</strong> </a>';
echo'<br>';
echo $row["date"];
echo '<br>';
echo $row["contenu"];


}

?>





</body>
</html>