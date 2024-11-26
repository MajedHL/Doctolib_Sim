<?php 

require_once("../model/ModelPersonne.php");

class ControllerPraticien{

   // return  all the patients of the logged praticien then display the result
    public static function praticien_get_patients(){

        $results=ModelPersonne::praticien_get_patients();        
        $title="Liste de mes patients";
        include 'config.php';    
        $vue=$root.'/app/view/Praticien/viewAny.php';
        require($vue);
        
            }


    public static function patient_getAll_Praticiens(){

        $results=ModelPersonne::patient_getAll_Praticiens();        
        include 'config.php';    
        $vue=$root.'/app/view/Praticien/Select_praticien.php';
        require($vue);
        
            }


    

                    
            

    


    







    
}

?>