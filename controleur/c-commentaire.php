<?php
include("../modele/m-commentaire.php");




if (isset($_POST['ajouter_commentaire']) && isset($_SESSION['id_utilisateur'])) {
    $contenu = $_POST['contenu'];
    $id_utilisateur = $_SESSION['id_utilisateur'];
ajoutCommentaire($db, $id_utilisateur, $id, $contenu);
header("Location: article.php?id=$id&commentaires=Afficher commentaires");
exit;
     
}

$commentaireUtilisateur = selectionCommentaire ($db);


if (isset($_POST['verification'])) {
    if (isset($_POST['id_commentaire'])) {

    if ($_POST['verification'] === 'oui') {
        $id_commentaire = intval($_POST['id_commentaire']);
        supprimeCommentaire ($db, $id_commentaire);
        header('Location: ../vue/admin.php?admin=Commentaires');
        exit;
    } else {
        header('Location: ../vue/admin.php?admin=Commentaires');
        exit;
    }
    } }

?>