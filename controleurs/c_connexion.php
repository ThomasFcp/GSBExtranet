<?php
setcookie("connexion", "", time()+3600);

if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
$action = $_GET['action'];
switch($action){
	
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_POST['login'];
		$mdp = $_POST['mdp'];
		$connexionOk = $pdo->checkUser($login,$mdp);
		if(!$connexionOk){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else { 
                        $infosMedecin = $pdo->donneLeMedecinByMail($login);
			$id = $infosMedecin['id'];
			$nom =  $infosMedecin['nom'];
			$prenom = $infosMedecin['prenom'];
			connecter($id,$nom,$prenom);
                        $connexionOk=$pdo->ajouteConnexion($id);
                        $_COOKIE["connexion"]=date('Y/m/d H:i:s');
			include("vues/v_sommaire.php");
			}

			break;
        }
        case 'valideDeconnexion':{
                $deconnexionOk=$pdo->enregistreDeconnexion($_SESSION['id']);
                include("vues/v_connexion.php");
                break;
	}
        
       
        
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>