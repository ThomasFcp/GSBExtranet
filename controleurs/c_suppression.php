<?php

if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
$action = $_GET['action'];
switch($action){
	
	case 'demandeSuppression':{
		include("vues/v_suppression.php");
		break;
	}
        case 'oui':{
                $deconnexionOk=$pdo->deleteMedecin($_SESSION['id']);
                include("vues/v_connexion.php");
                break;
	}	
}