
<?php 
define('ADMINISTRATEUR', 0);
define('PRATICIEN', 1);
define('PATIENT', 2);


?>
<?php 
require('Model.php');

if(!isset($_SESSION)) {
    session_start();
}

class ModelPersonne{


    public static  $ADMINISTRATEUR = ADMINISTRATEUR;
    public static  $PRATICIEN = PRATICIEN;
    public static  $PATIENT = PATIENT;



    public static function insert_person($nom,$prenom,$adresse,$login,$password,$statut,$specialite_label){
        try{            
            
            $database=Model::getInstance();
            
            $query="select COUNT(*)from personne where login=:login; ";
            $statement=$database->prepare($query);
            $statement->execute(["login"=>$login]);
            $row=$statement->fetch();
            $count=$row['0'];
            if($count>0) return -1;
            
            
            
            
            $query="select Max(id) from personne";
            $statement=$database->prepare($query);
            $statement->execute();
            $row=$statement->fetch();
            $id=$row['0'];
            $id++;
            


            $query="select id from specialite where label=:label";
            $statement=$database->prepare($query);
            $statement->execute(["label"=>$specialite_label]);
            $row=$statement->fetch();
            $specialite_id=$row['0'];



            $query="insert into personne value(:id,:nom,:prenom,:adresse,:login,:password,:statut,:specialite_id)";    
            $statement=$database->prepare($query);     
            //const  
            switch($statut){
            case "Administrateur":
                $statut=ModelPersonne::$ADMINISTRATEUR;
                break;
            case "Patient":
                $statut=ModelPersonne::$PATIENT;
                break;
            case "Praticien": 
                $statut=ModelPersonne::$PRATICIEN;
                break;  
            }
            
            
           
            $results= $statement->execute([
                "id"=>$id,
                "nom"=>$nom,
                "prenom"=>$prenom,
                "adresse"=>$adresse,
                "login"=>$login,
                "password"=>$password,
                "statut"=>$statut,
                "specialite_id"=>$specialite_id
            ]);  
             return $id;
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
        }
    }





    public static function login($login,$password){
        
        try{ 
         $database=Model::getInstance();
         $query="select * from personne where login=:login AND password=:password";
         $statement=$database->prepare($query);
             $statement->execute([
                 "login"=>$login,
                 "password"=>$password
             ]);
             $matches=$statement->rowCount();
             if($matches==0) return false;
            else { 
             if(!isset($_SESSION)) {
                 session_start();
             }            
             $row=$statement->fetch(PDO::FETCH_ASSOC);
             $_SESSION['login']=$login;
             $_SESSION['nom']=$row['nom'];
             $_SESSION['prenom']=$row['prenom'];
             
             switch($row['statut']){
                 //const
                 case ModelPersonne::$ADMINISTRATEUR :
                     $statut="Administrateur";
                     break;
                 case ModelPersonne::$PATIENT :
                     $statut="Patient";
                     break;
                 case ModelPersonne::$PRATICIEN : 
                     $statut="Praticien";
                     break;  
                 }
             
             
             $_SESSION['statut']=$statut;
             
             
         return  true;     
         }
     }catch (PDOException $e){        
         printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
     return false;
     }     
     
         }






    public static function admin_praticien_specialite(){
        
        try {            
            $database=Model::getInstance();
            $query="SELECT p.id,p.nom,p.prenom,p.adresse,s.label FROM personne p,specialite s where s.id=p.specialite_id and p.statut=1; ";
            $statement=$database->prepare($query);
            $statement->execute();
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }
    }


    public static function admin_praticiens_ParPatient(){
        
        try {            
            $database=Model::getInstance();
            $query="SELECT pat.nom,pat.prenom, COUNT(praticien_id) as particiens FROM `rendezvous`,personne pat where pat.id=patient_id  
            and pat.id<>0 GROUP BY patient_id; ";
            $statement=$database->prepare($query);
            $statement->execute();
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }
    }

    public static function admin_getPatients(){
        
        try {            
            $database=Model::getInstance();
            $query="SELECT id,nom,prenom,adresse from personne where statut=:statut and id<>0";
            $statement=$database->prepare($query);
            $statement->execute(["statut"=>ModelPersonne::$PATIENT]);
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }
    }




    public static function admin_getAdmins(){
        
        try {            
            $database=Model::getInstance();
            $query="SELECT id,nom,prenom,adresse from personne where statut=:statut ";
            $statement=$database->prepare($query);
            $statement->execute(["statut"=>ModelPersonne::$ADMINISTRATEUR]);
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }
    }






    //****************************************************  PRATICIEN               ***************************/
    public static function praticien_get_patients(){
        try{
            $database=Model::getInstance();
            $query="SELECT DISTINCT pat.nom as patient_nom,pat.prenom as patient_prenom FROM rendezvous r,personne pat,personne prat 
            WHERE pat.id=r.patient_id and prat.id=r.praticien_id and prat.login=:login and pat.id<>0 ";
            $statement=$database->prepare($query);
            $statement->execute(["login"=>$_SESSION['login']]);
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
    
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }


    }
    
    
 //****************************************************  PATIENT               ***************************/

 public static function patient_compte(){
    try{
        $database=Model::getInstance();
        $query="SELECT * from personne where login=:login ";
        $statement=$database->prepare($query);
        $statement->execute(["login"=>$_SESSION['login']]);
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;


    }catch (PDOException $e){        
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return false;
        }

 }


 public static function patient_getRdvs(){
    try{
        $database=Model::getInstance();
        $query="SELECT prat.nom,prat.prenom,r.rdv_date FROM `personne`prat,personne pat,rendezvous r
        WHERE r.praticien_id=prat.id and r.patient_id=pat.id and pat.login=:login; ";
        $statement=$database->prepare($query);
        $statement->execute(["login"=>$_SESSION['login']]);
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;


    }catch (PDOException $e){        
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return false;
        }

 }



 public static function patient_getAll_Praticiens(){
    try{
        $database=Model::getInstance();
        $query="SELECT prat.id,prat.nom,prat.prenom FROM `personne`prat  WHERE prat.statut=:statut";
        $statement=$database->prepare($query);
        $statement->execute(["statut"=>ModelPersonne::$PRATICIEN]);
        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;


    }catch (PDOException $e){        
        printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return false;
        }

 }
 


 

    





}

?>