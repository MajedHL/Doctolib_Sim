<?php 
require_once("../model/ModelPersonne.php");


class ControllerPatient{



    public static function patient_compte(){
        $results=ModelPersonne::patient_compte();
        $title="Mon Compte";
        include 'config.php';
        $vue=$root. '/app/view/Patient/viewAny.php';
        require($vue);
    }




    public static function patient_getRdvs(){
        $results=ModelPersonne::patient_getRdvs();
        $title="Liste de mes rendez-vous";
        include 'config.php';
        $vue=$root. '/app/view/Patient/viewAny.php';
        require($vue);
    }
    


    




}
?>