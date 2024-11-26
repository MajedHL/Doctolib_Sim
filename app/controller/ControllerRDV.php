<?php 

require_once("../model/ModelRDV.php");
class ControllerRDV{



  // return an array of all rdv of the logged praticien then display it
    public static function praticien_getAllDispo(){
        $results=ModelRDV::getAllDispo();
        $title="Liste de mes diponibilités";
        include 'config.php';
        $vue=$root.'/app/view/RDV/viewAny.php';
        require($vue);
    }




   // display the form to add a rdv to the logged praticien
    public static function praticien_ToAdd_rdv(){
        include 'config.php';
        $title="Ajout de nouvelles disponibilités";
        $vue=$root."/app/view/RDV/viewToNewDispo.php";
        require($vue);
    }


   // add rdvs and retrun an array of added rdvs to the logged praticien then display the added rdv
    public static function praticien_add_rdv(){
    $results=ModelRDV::praticien_add_rdv($_GET['rdv_date'],$_GET['rdv_nombre']);
    include 'config.php';
    if($results<0) $vue=$root.'/app/view/RDV/InvalidInput.php';
    else $vue=$root.'/app/view/RDV/viewAny.php';
    require($vue);
        
    }


    // return an array of the rdv date with patients for the logged praticien then display it
    public static function praticien_Rdv_patients(){
    $results=ModelRDV::Rdv_patients();
    $title="Liste de mes rendez-vous";
    include 'config.php';
    $vue=$root.'/app/view/RDV/viewAny.php';
    require($vue);
    }





    public static function patient_Get_praticienDispos(){
        $results=ModelRDV::patient_Get_praticienDispos($_GET['id']);        
        include 'config.php';    
        $vue=$root.'/app/view/RDV/Select_RDV.php';
        require($vue);
        
            }




    public static function patient_addRDV(){
        $results=ModelRDV::patient_addRDV($_GET['rdv_id']);     
        include 'config.php';    
        $vue=$root.'/app/view/RDV/viewInserted.php';
        require($vue);
    
    }










}





?>