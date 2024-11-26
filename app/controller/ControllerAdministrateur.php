<?php 
require_once("../model/ModelPersonne.php");
require_once("../model/ModelRDV.php");
require_once("../model/ModelSpecialite.php");

class ControllerAdministrateur{




    //retourn la liste des praticiens avec leur spécialités, ensuite affiche les résultats
    public static function admin_praticien_specialite(){
        $results=ModelPersonne::admin_praticien_specialite();
        $title="Lise des praticiens";
        include("config.php");
        $vue=$root .'/app/view/Administrateur/viewAny.php';
        require($vue);
    }

    //retourn le nombre des praticiens par patient, ensuite affiche les résultats
    public static function admin_praticiens_ParPatient(){
        $results=ModelPersonne::admin_praticiens_ParPatient();
        $title="Nombre des praticiens par patient";
        include("config.php");
        $vue=$root .'/app/view/Administrateur/viewAny.php';
        require($vue);
    }




    public static function admin_Info(){

        $specialites=ModelSpecialite::getSpecialites();
        $praticiens=ModelPersonne::admin_praticien_specialite();
        $patients=ModelPersonne::admin_getPatients();
        $admins=ModelPersonne::admin_getAdmins();
        $rdvs=ModelRDV::getAllRDVs();

        include 'config.php';
        $vue=$root .'/app/view/Administrateur/viewInfo.php';
        require($vue);

    }


    



}

?>