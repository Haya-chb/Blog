<?php

include("../connexion.php");


function commentaireByid_billet ($db, $id){
$stmt = $db->prepare("SELECT * FROM commentaire 
                        JOIN utilisateurs ON commentaire.id_utilisateur = utilisateurs.id_utilisateur 
                        WHERE id_billet = :id 
                        ORDER BY date_commentaire DESC");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

function ajoutCommentaire ($db, $id_utilisateur, $id, $contenu){

    $stmt = $db->prepare("INSERT INTO commentaire (id_utilisateur, id_billet, contenu, date_commentaire)
                                  VALUES (:id_utilisateur, :id_billet, :contenu, NOW())");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur , PDO::PARAM_INT);
            $stmt->bindParam(':id_billet', $id, PDO::PARAM_INT);
            $stmt->bindParam(':contenu', $contenu, PDO::PARAM_STR);
            return $stmt->execute();
}



function selectionCommentaire ($db){

    $stmt = $db->prepare('SELECT * FROM commentaire JOIN utilisateurs ON commentaire.id_utilisateur = utilisateurs.id_utilisateur');
    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function supprimeCommentaire ($db, $id_commentaire){
    $stmt = $db->prepare('DELETE FROM commentaire WHERE id_commentaire = :id');
    $stmt->bindParam(':id', $id_commentaire, PDO::PARAM_INT);
    return $stmt->execute();

}





?>