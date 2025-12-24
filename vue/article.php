<?php
session_start();
include("../connexion.php");
include("../controleur/c-billet.php");
include("../controleur/c-commentaire.php");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
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


    if ($article) {
        echo '<h2>' . $article["titre"] . '</h2>';
        echo '<p>' . $article["date"] . '</p>';
        echo '<p>' . $article["contenu"] . '</p>';
    } else {
        echo '<p>Article introuvable.</p>';
    }


    if (isset($_GET['commentaires'])) {
        if ($_GET['commentaires'] === 'Afficher commentaires') {
            echo '<form action="article.php" method="get">';
            echo '<input type="hidden" name="id" value="'.$id.'">';
            echo '<input type="submit" value="Masquer commentaires" name="commentaires">';
            echo '</form>';


    

            if ($commentaires) {
                foreach ($commentaires as $commentaire) {
                    echo '<p><strong>' . $commentaire["login"] . '</strong> (' . $commentaire["date_commentaire"] . ')</p>';
                    echo '<p>' . $commentaire["contenu"] . '</p><br>';
                }
            } else {
                echo '<p>Aucun commentaire pour cet article.</p>';
            }


            if (isset($_SESSION['id_utilisateur'])) {
                echo '<h3>Ajouter un commentaire :</h3>';
                echo '<form action="../controleur/c-commentaire.php" method="post">';
                echo '<textarea name="contenu" cols="60" rows="5"></textarea><br>';
                echo '<input type="submit" name="ajouter_commentaire" value="Envoyer">';
                echo '</form>';
            } else {
                echo '<p>Connectez-vous pour laisser un commentaire.</p>';
            }

        } elseif ($_GET['commentaires'] === 'Masquer commentaires') {
            echo '<form action="article.php" method="get">';
            echo '<input type="hidden" name="id" value="'.$id.'">';
            echo '<input type="submit" value="Afficher commentaires" name="commentaires">';
            echo '</form>';
        }

    } else {
        echo '<form action="article.php" method="get">';
        echo '<input type="hidden" name="id" value="'.$id.'">';
        echo '<input type="submit" value="Afficher commentaires" name="commentaires">';
        echo '</form>';
    }


  


?>

</body>
</html>
