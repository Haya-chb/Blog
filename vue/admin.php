<?php

include('../controleur/c-billet.php');
include('../controleur/c-utilisateurs.php');
include('../controleur/c-commentaire.php');
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin-style.css">
    <title>Administrateur</title>
</head>
<body>



<nav>
    <a href="../index.php">Acceuil</a>
    <a href="archives.php">Archives</a>
    <a href="admin.php?admin=Articles">Administrateur</a>

   
<form action="../deconnexion.php" method="post">
<input type="submit" value="Déconnexion">
</form>

</nav>

<form action="admin.php" method="get">
    <input type="submit" value="Articles" name="admin">
    <input type="submit" value="Utilisateurs" name="admin">
    <input type="submit" value="Commentaires" name="admin">
    <input type="submit" value="Poster un article" name="admin">
</form>

 <main>
<?php

if (isset($_GET['admin'])){

    if ($_GET['admin'] === 'Articles') {

        echo'<h2>Articles</h2>';
        echo'<br><br>';

        foreach ($result as $row){

            echo $row["date"];
            echo'<br>';
            echo '<a href="article.php?id='.$row["id_billet"].'"> <strong>'.$row["titre"].'</strong> </a>';
            echo'<br>';

            echo '<form action="admin.php" method="get">';
            echo '<input type="hidden" name="id_billet" value="'.$row["id_billet"].'">';
            echo '<input type="hidden" name="admin" value="Articles">';
            echo'<input type="submit" name="modifier" value="Modifier">';
            echo'<input type="submit" name="supprimer" value="Supprimer article">';
            echo'</form>';
            echo'<br>';
        }
    }

    elseif ($_GET['admin'] === 'Utilisateurs') {

        echo '<h2>Utilisateurs</h2><br>';


        foreach ($utilisateur as $row) {
            echo $row["login"] . '<br>';
            echo '<img src="' . $row["photo"] . '" alt="photo" width="100"><br>';
            echo '<form action="admin.php" method="get">';
            echo '<input type="hidden" name="id_utilisateur" value="'.$row["id_utilisateur"].'">';
            echo '<input type="hidden" name="admin" value="Utilisateurs">';
            echo'<input type="submit" name="supprimer" value="Supprimer utilisateur">';
            echo'</form>';
            echo'<br><br>';
        }
    }

    elseif ($_GET['admin']==='Commentaires') {

        echo'<h2>Commentaires</h2> ';
        echo'<br><br>';

       
        foreach ($commentaireUtilisateur as $row){

            echo $row["date_commentaire"];
            echo '<br>';
            echo $row["login"];
            echo '<br>';
            echo $row["contenu"];
            echo '<br>';

            echo '<form action="admin.php" method="get">';
            echo '<input type="hidden" name="id_commentaire" value="'.$row["id_commentaire"].'">';
            echo '<input type="hidden" name="admin" value="Commentaires">';
            echo'<input type="submit" name="supprimer" value="Supprimer commentaire">';
            echo'</form>';
            echo'<br><br>';
        }

    }

    elseif ($_GET['admin']==='Poster un article') {
        echo'<h2>Poster un article</h2> ';
        echo'<br><br>';

        echo '<form action="../controleur/c-billet.php" method="post">';
        echo'<div>';
        echo'<label for="titre">Titre de l\'article :</label>';
        echo'<br>';
        echo'<input type="text" id="titre" name="titre">';
        echo'</div>';
        echo'<br>';
        echo'<div>';
        echo'<label for="date">Date de l\'article :</label>';
        echo'<br>';
        echo'<input type="date" id="date" name="date">';
        echo'</div>';
        echo'<br>';
        echo'<div>';
        echo'<label for="contenu">Contenu de l\'article :</label>';
        echo'<br>';
        echo'<textarea name="contenu" id="contenu" cols="50" rows="20"></textarea>';
        echo'</div>';
        echo'<input type="hidden" name="admin" value="Poster un article">';
        echo'<input type="submit" name="poster_article" value="Poster">';
        echo'</form>';
    }

} else {
    echo'';
}


if (isset($_GET['supprimer'])) {

    if ($_GET['supprimer'] === 'Supprimer utilisateur' && isset($_GET['id_utilisateur'])) {
        $id_utilisateur = intval($_GET['id_utilisateur']);

        echo'<form action="../controleur/c-utilisateurs.php" method="post">';
        echo '<input type="hidden" name="id_utilisateur" value="'.$id_utilisateur.'">';
        echo '<input type="hidden" name="admin" value="Utilisateurs">';
        echo'<label>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</label>';
        echo'<input type="submit" value="oui" name="verification">';
        echo'<input type="submit" value="non" name="verification">';
        echo'</form>';
    }

    elseif ($_GET['supprimer'] === 'Supprimer commentaire' && isset($_GET['id_commentaire'])) {
        $id_commentaire = intval($_GET['id_commentaire']);

        echo'<form action="../controleur/c-commentaire.php" method="post">';
        echo '<input type="hidden" name="id_commentaire" value="'.$id_commentaire.'">';
        echo '<input type="hidden" name="admin" value="Commentaires">';
        echo'<label>Êtes-vous sûr de vouloir supprimer ce commentaire ?</label>';
        echo'<input type="submit" value="oui" name="verification">';
        echo'<input type="submit" value="non" name="verification">';
        echo'</form>';
    }

    elseif ($_GET['supprimer'] === 'Supprimer article' && isset($_GET['id_billet'])) {
        $id_billet = intval($_GET['id_billet']);

        echo'<form action="../controleur/c-billet.php" method="post">';
        echo '<input type="hidden" name="id_billet" value="'.$id_billet.'">';
        echo '<input type="hidden" name="admin" value="Articles">';
        echo'<label>Êtes-vous sûr de vouloir supprimer cet article ?</label>';
        echo'<input type="submit" value="oui" name="verification">';
        echo'<input type="submit" value="non" name="verification">';
        echo'</form>';
    }
}


 if ($modif && $article) {
            echo '<form action="../controleur/c-billet.php" method="post">';
            echo '<input type="hidden" name="id_billet" value="'.$article['id_billet'].'">';
            echo '<input type="hidden" name="admin" value="Articles">';
            echo '<label>Modifier le contenu de l\'article :</label><br>';
            echo '<textarea name="nouveau_contenu" cols="60" rows="15">'.$article['contenu'].'</textarea><br>';
            echo '<input type="submit" name="enregistrer_modif" value="Enregistrer">';
            echo '<input type="submit" name="annuler_modif" value="Annuler">';
            echo '</form>';
        }





?>
</main>
</body>
</html>
