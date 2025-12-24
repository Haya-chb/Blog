<?php


include("modele/m-utilisateurs.php");


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
    
        verifieLogin($db, $login);

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
        utilisateurExiste($db, $login);
            
    if ($utilisateurExiste && password_verify($mdp, $utilisateur['password'])) {
                
        $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
        $_SESSION['proprietaire']=$utilisateur['proprietaire'];
        $_SESSION['login'] = $utilisateur['login'];
        header('Location: ../index.php');
                
        } else {
        echo '<p>Login ou mot de passe incorrect.</p>';
            }
        }

$limite = limiteBillet ($db);
    
?>