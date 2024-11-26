<?php 
require_once("Model.php");


class ModelRDV{






    public static function getAllDispo(){

        try{
            $database=Model::getInstance();
            $query="SELECT rdv_date as disponibilités FROM rendezvous r,personne p WHERE p.id=r.praticien_id and p.login=:login and r.patient_id=0; ";
            $statement=$database->prepare($query);
            $statement->execute(["login"=>$_SESSION['login']]);
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
    
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }
    
    
    }



    public static function getAllRDVs(){

        try{
            $database=Model::getInstance();
            $query="SELECT r.id,r.rdv_date,prat.nom as \"nom praticien\",prat.prenom as \"prenom praticien\",pat.nom as \"nom patient\"
            ,pat.prenom as \"prenom patient\" FROM `rendezvous`r,personne prat,personne pat WHERE patient_id=pat.id and praticien_id=prat.id and pat.id<>0; ";
            $statement=$database->prepare($query);
            $statement->execute();
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
    
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }
    
    
    }





    public static function praticien_add_rdv($date,$nombre){

        try{if($nombre<1 || $nombre>10) return -1;
            
        $regex = "/^\d{4,}-\d{2}-\d{2}$/";
        if(!preg_match($regex, $date)) return -2;
            
        $dateParts = explode("-", $date);        
        if (count($dateParts) === 3) {
            $year = intval($dateParts[0]);
            $month = intval($dateParts[1]);
            $day = intval($dateParts[2]);        
            if($month>12 || $month<1) return -3;
            if($day>31 || $day<1) return -4;
        }
    
            $database=Model::getInstance();            
            $query="select Max(id) from rendezvous";
                $statement=$database->prepare($query);
                $statement->execute();
                $row=$statement->fetch();
                $id=$row['0'];
                $id++;
               
                $query="select id from personne where login=:login";
                $statement=$database->prepare($query);
                $statement->execute([
                    "login"=>$_SESSION['login']
                ]);
                $row=$statement->fetch();
                $praticien_id=$row['0'];
                $results=array();
              
              $query=  "SELECT Max(HOUR(STR_TO_DATE(rdv_date, '%Y-%m-%d à %Hh%i'))) AS hour
                        FROM rendezvous
                        WHERE DATE(STR_TO_DATE(rdv_date, '%Y-%m-%d à %Hh%i')) = :date and praticien_id=:praticien_id";

                    $statement=$database->prepare($query);
                    $statement->execute(["date"=>$date,"praticien_id"=>$praticien_id]);
                    $row=$statement->fetch();
                    $hour=$row[0];
                    if($hour<10) $hour=9;
                    $i=0;
                    while($i<$nombre && $hour<23){
            $query="insert into rendezvous value (:id,:patient_id,:praticien_id,:rdv_date) ";
            $hour=$hour+1;
            $statement=$database->prepare($query);       
            $statement->execute([
                "id"=>$id,
                "patient_id"=>0,
                "praticien_id"=>$praticien_id,
                "rdv_date"=>$date." à ".$hour."h00"
                
            ]);
            
            $row=array("disponibilités ajoutés"=>$date." à ".$hour."h00" );
            $results[]=$row;    
            $id++;    
            $i++;            
                    }
        
        return $results;
    
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }
        }








            public static function Rdv_patients(){
                try{
                    $database=Model::getInstance();
                    $query="SELECT pat.nom as nom,pat.prenom as prenom,r.rdv_date FROM rendezvous r,personne pat,personne prat
                     WHERE pat.id=r.patient_id and prat.id=r.praticien_id and prat.login=:login and pat.id<>0";
                    $statement=$database->prepare($query);
                    $statement->execute(["login"=>$_SESSION['login']]);
                    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                    return $results;
            
            
                }catch (PDOException $e){        
                    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return false;
                    }


            }



            public static function patient_Get_praticienDispos($id){
                try{
                    $database=Model::getInstance();
                    $query="SELECT r.id,r.rdv_date as disponibilités FROM rendezvous r,personne p WHERE p.id=r.praticien_id and p.id=:id and r.patient_id=0;";
                    $statement=$database->prepare($query);
                    $statement->execute(["id"=>$id]);
                    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                    return $results;
            
            
                }catch (PDOException $e){        
                    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return false;
                    }

            }



           

            public static function patient_addRDV($rdv_id){
                try{
                    $database=Model::getInstance();
                   
                    $query="select id from personne where login=:login ";
                    $statement=$database->prepare($query);
                    $statement->execute([
                        "login"=>$_SESSION['login']                        
                    ]);
                    $row=$statement->fetch();
                    $patient_id=$row['0'];
                    
                    $query="select patient_id from rendezvous where id=:rdv_id ";
                    $statement=$database->prepare($query);
                    $statement->execute([
                        "rdv_id"=>$rdv_id                        
                    ]);
                    $row=$statement->fetch();
                    $patient_idOfRDV=$row[0];
                    if($patient_idOfRDV!=0)return false;
                    
                    $query="update rendezvous set patient_id=:patient_id where id=:rdv_id ";
                    $statement=$database->prepare($query);
                    $statement->execute([
                        "patient_id"=>$patient_id,
                        "rdv_id"=>$rdv_id
                    ]);

                    $query="Select p.nom,p.prenom,r.rdv_date from personne p, rendezvous r where r.praticien_id=p.id and r.id=:rdv_id";
                    $statement=$database->prepare($query);
                    $statement->execute([
                        "rdv_id"=>$rdv_id
                    ]);
                    $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                    $row=$results[0];
                    return $row;
            
                }catch (PDOException $e){        
                    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return false;
                    }

            }

            





            







    
    
    
    }


































?>