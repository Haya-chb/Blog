<?php


include("../modele/m-utilisateurs.php");


$utilisateur = seletionUtilisateur ($db);


if (isset($_POST['verification'])) {

    if (isset($_POST['id_utilisateur'])) {

        if ($_POST['verification'] === 'oui') {
            $id_utilisateur = intval($_POST['id_utilisateur']);
            suuprimeUtilisateur($db, $id_utilisateur);
            header('Location: admin.php?admin=Utilisateurs');
            exit;
        } else {
            header('Location: admin.php?admin=Utilisateurs');
            exit;
        }
    }}

    if (isset($_POST['valider_inscription'])) {

        $login = $_POST['login'];
        $mdp = $_POST['pswd'];
        $hash = password_hash($mdp, PASSWORD_DEFAULT); 
        
        $image = null;
        if (!empty($_FILES['file']['name'])) {
            $tmpName = $_FILES['file']['tmp_name'];
            $name = basename($_FILES['file']['name']);
            move_uploaded_file($tmpName, 'photo-profil/' . $name);
            $image = 'photo-profil/' . $name;
        }
    
        $existe = verifieLogin($db, $login);

        if ($existe) {
            echo '<p> Ce login est déja prit.</p>';
        } else {
            inscription($db, $login, $hash, $image);
            echo '<p> Inscription réussie. Vous pouvez vous connecter.</p>';
        }
    }

    if (isset($_POST['valider_connexion'])) {
        $login = trim($_POST['login']);
        $mdp = $_POST['pswd']; 
        $utilisateur = utilisateurExiste($db, $login);
            
    if ($utilisateur && password_verify($mdp, $utilisateur['password'])) {
                
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['proprietaire']=$utilisateur['proprietaire'];
        $_SESSION['login'] = $utilisateur['login'];
        header('Location: index.php');
        exit;
                
        } else {
        echo '<p>Login ou mot de passe incorrect.</p>';
            }
        }

$limite = limiteBillet ($db);
    
?>