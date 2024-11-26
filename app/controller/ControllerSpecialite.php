<?php 


require_once("../model/ModelSpecialite.php");

class ControllerSpecialite{




    public static function admin_getSpecialites(){
        $results=ModelSpecialite::getSpecialites();
        $title="Lise des spécialités";
        include 'config.php';
        $vue=$root .'/app/view/Specialite/viewAny.php';
        require($vue);
      
          }
      
      
          public static function admin_specialite_getAllId(){
              $results=ModelSpecialite::specialite_getAllId();
              include 'config.php';
              $vue=$root .'/app/view/Specialite/viewAllid.php';
              require($vue);
      
          }
      
      
          public static function admin_specialite_getById(){
              $results=ModelSpecialite::specialite_getById($_GET['id']);
              include 'config.php';
              $vue=$root .'/app/view/Specialite/viewAny.php';
              require($vue);
          }
      
      
      
      
          public static function admin_ToInsert(){
              $results=1;
              $title="Création d'une nouvelle spécialité";
              include 'config.php';
              $vue=$root .'/app/view/Specialite/viewToInsert.php';
              require($vue);
          }
      
      
          public static function admin_insert(){
          $results=ModelSpecialite::insert($_GET['specialite']);
          include("config.php");    
          if($results==-1) $vue=$root .'/app/view/Specialite/viewToInsert.php';
          else $vue=$root .'/app/view/Specialite/viewInserted.php';    
          require($vue);
          }

}





?>