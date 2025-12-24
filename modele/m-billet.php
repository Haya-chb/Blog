<?php
include("../connexion.php");


function selectionBillet ($db) {

    $stmt = $db->prepare('SELECT * FROM billet');
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function idBillet($db, $id) {

    $stmt = $db->prepare("SELECT * FROM billet WHERE id_billet = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function supprimeBillet($db, $id_billet){

    $stmt = $db->prepare('DELETE FROM billet WHERE id_billet = :id');
    $stmt->bindParam(':id', $id_billet, PDO::PARAM_INT);
    $stmt->execute();
}

function modifBillet($db,$id_billet,$nouveau_contenu){
$stmt = $db->prepare('UPDATE billet SET contenu = :contenu WHERE id_billet = :id');
$stmt->bindParam(':contenu', $nouveau_contenu, PDO::PARAM_STR);
$stmt->bindParam(':id', $id_billet, PDO::PARAM_INT);
$stmt->execute();
}

function nouveauBillet($db,$titre,$date,$contenu) {

    $stmt = $db->prepare('INSERT INTO billet (titre, date, contenu) VALUES (:titre, :date, :contenu)');
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
    $stmt->execute();
}

function verifierBillet ($db,$id_billet);
$stmt = $db->prepare('SELECT * FROM billet WHERE id_billet = :id');
        $stmt->bindParam(':id', $id_billet, PDO::PARAM_INT);
        $stmt->execute();
        $modif = $stmt->fetch(PDO::FETCH_ASSOC);




?>