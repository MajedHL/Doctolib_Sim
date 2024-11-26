<?php 
require_once("../model/ModelSpecialite.php");
require_once("../model/ModelPersonne.php");
require_once('../model/Model.php');
class ControllerHome{


public static function home(){
   include 'config.php';   
   $vue=$root.'/app/view/home.php';
   require($vue);
}

public static function inscrire(){
    $results=ModelSpecialite::getSpecialite_labels();
    $login_used=1;
    include 'config.php';
    $vue=$root."/app/view/Seconnecter/inscrire.php";
    require($vue);
}

public static function Personne_insert(){
$results=ModelPersonne::insert_person($_GET["nom"],$_GET["prenom"],$_GET["adresse"],$_GET["login"],$_GET["password"],$_GET["statut"],$_GET["specialite"]);
include 'config.php';
if($results!=-1){    
    $vue=$root ."/app/view/Seconnecter/Inserted.php";
    require($vue);
    }
else{ // quand le login est déja utilisé
    $login_used=$results;//=-1
    $results=ModelSpecialite::getSpecialite_labels();
    $vue=$root."/app/view/Seconnecter/inscrire.php";
    require($vue);
    }
}


public static function Personne_login(){
include 'config.php';
$results=true;
$vue=$root.'/app/view/Seconnecter/login.php';
require($vue);

}


public static function handle_login(){
    $results=ModelPersonne::login($_GET['login'],$_GET["password"]);
    include 'config.php';    
    if($results){
        $vue=$root.'/app/view/home.php';
        require($vue);
    }
    else{
        $vue=$root."/app/view/Seconnecter/login.php";
        require($vue);
    }

}





public static function deconnexion(){
    if(!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['login']='';    
   session_destroy();
    include 'config.php';   
   $vue=$root.'/app/view/home.php';
   require($vue);
}




public static function fonctionnalite(){
    include 'config.php';   
   $func=true;
   $amel=false;
    $vue=$root.'/app/view/Innovations/Innovations.php';
    require($vue);
}

public static function amelioration(){
    include 'config.php';   
   $func=false;
   $amel=true;
    $vue=$root.'/app/view/Innovations/Innovations.php';
    require($vue);
}



}

?>