<?php
include("../modele/m-billet.php");

$result = selectionBillet($db);

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);}

$article = idBillet($db, $id);


if (isset($_POST['verification'])) {
    if (isset($_POST['id_billet'])) {

    if ($_POST['verification'] === 'oui') {
        $id_billet = intval($_POST['id_billet']);
        supprimeBillet($db, $id_billet);
        header('Location: admin.php?admin=Articles');
        exit;
    } else {
        header('Location: admin.php?admin=Articles');
        exit;
    }
}
}


if (isset($_POST['enregistrer_modif']) && isset($_POST['id_billet'])) {
    $id_billet = intval($_POST['id_billet']);
    $nouveau_contenu = $_POST['nouveau_contenu'];
    modifBillet($db,$id_billet,$nouveau_contenu)
    header('Location: admin.php?admin=Articles');
    exit;
}

if (isset($_POST['annuler_modif'])) {
    header('Location: admin.php?admin=Articles');
    exit;
}

if (isset($_POST['poster_article'])) {
    $titre = $_POST['titre'];
    $date = $_POST['date'];
    $contenu = $_POST['contenu'];
    nouveauBillet($db,$titre,$date,$contenu)
    header('Location: admin.php?admin=Articles');
    exit;
    
}

if (isset($_GET['modifier'])) {

    if ($_GET['modifier'] === 'Modifier' && isset($_GET['id_billet'])) {
        $id_billet = intval($_GET['id_billet']);
        verifierBillet($db,$id_billet);

    }
}
?>