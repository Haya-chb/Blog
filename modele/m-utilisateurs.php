<?php
include("connexion.php");

function seletionUtilisateur ($db){
    $stmt = $db->prepare('SELECT * FROM utilisateurs');
    $stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function supprimeUtilisateur($db, $id_utilisateur){

    $stmt = $db->prepare('DELETE FROM utilisateurs WHERE id_utilisateur = :id');
    $stmt->bindParam(':id', $id_utilisateur, PDO::PARAM_INT);
    $stmt->execute();
}

function verifieLogin ($db, $login) {
    $check = $db->prepare('SELECT login FROM utilisateurs WHERE login = :login LIMIT 1');
    $check->bindParam(':login', $login, PDO::PARAM_STR);
    $check->execute();
    $existe = $check->fetch(PDO::FETCH_ASSOC);
    }

function inscription ($db, $login, $hash, $image) {
    $stmt = $db->prepare('INSERT INTO utilisateurs (login, password, proprietaire, photo) VALUES (:login, :password, 0, :photo)');
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
    $stmt->bindParam(':photo', $image, PDO::PARAM_STR);
    $stmt->execute();
}

function utilisateurExiste ($db, $login) {
    $stmt = $db->prepare('SELECT id_utilisateur, login, password, proprietaire FROM utilisateurs WHERE login = :login');
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->execute();
    $utilisateurExiste = $stmt->fetch(PDO::FETCH_ASSOC);
}

function limiteBillet ($db){
$stmt = $db->prepare('SELECT * FROM billet ORDER BY date DESC LIMIT 3');
$stmt->execute(); 
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>