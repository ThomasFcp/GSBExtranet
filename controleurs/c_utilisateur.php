<?php


if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeConnexion';
}
$action = $_GET['action'];
switch($action){
        case "demandeDeModification":{
        include("vues/v_rectification.php");
             break;       
        }
        case "modification":{
        $nom=$_POST['modifNom'];
        $prenom=$_POST['modifPrenom'];
        $id=$_SESSION['id'];
        $mdp= htmlspecialchars($_POST['modifMdp']);
        $mdp2= htmlspecialchars($_POST['modifMdp2']);
        $pdo= PdoGsb::getPdoGsb();
        $rempli=false;
        if(empty($mdp)==true && empty($mdp2)==true){
            $modifSansMDP=$pdo->rectificationSansMdp($nom, $prenom, $id);
            $message="Modification effectuée";
            echo $message;
        $rempli=false;}
        else {
            if(verif2Strings($mdp, $mdp2)==true){
                 if (verifSecuPWP($mdp)){
                     $modifAvecMDP=$pdo->rectificationAvecMdp($nom, $prenom, $mdp, $id);
                                 $modifSansMDP=$pdo->rectificationSansMdp($nom, $prenom, $id);
            $message="Modification effectuée";
            echo $message;
        $rempli=true;}
            } 
            else {
                echo "les mots de passe ne sont pas similaires";
            }
            }

            }
        
            break;
        }
?>