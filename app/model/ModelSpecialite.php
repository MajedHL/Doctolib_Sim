<?php 
require_once("Model.php");

class ModelSpecialite{



    public static function getSpecialite_labels(){
        try {            
            $database=Model::getInstance();
            $query="select label FROM specialite ";
            $statement=$database->prepare($query);
            $statement->execute();
            $results=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
    
        }catch (PDOException $e){        
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
        return false;
            }
        }


        public static function getSpecialites(){
            try {                
                $database=Model::getInstance();
                $query="select * FROM specialite ";
                $statement=$database->prepare($query);
                $statement->execute();
                $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                return $results;
        
            }catch (PDOException $e){        
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
                }
            }
    
    
    
        public static function specialite_getAllId(){
            try {                
                $database=Model::getInstance();
                $query="select id FROM specialite ";
                $statement=$database->prepare($query);
                $statement->execute();
                $results=$statement->fetchAll(PDO::FETCH_COLUMN, 0);
                return $results;
        
            }catch (PDOException $e){        
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
                }
    
        }
        
    
        public static function specialite_getById($id){
            try {                
                $database=Model::getInstance();
                $query="select * FROM specialite where id=:id ";
                $statement=$database->prepare($query);
                $statement->execute(["id"=>$id]);
                $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                return $results;
        
            }catch (PDOException $e){        
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
                }
    
        }
    
    
    
        public static function insert($label){
        try {                
                $database=Model::getInstance();                
                $query="select COUNT(*)from specialite where label=:label; ";
                $statement=$database->prepare($query);
                $statement->execute(["label"=>$label]);
                $row=$statement->fetch();
                $count=$row['0'];
                if($count>0) return -1;
                
                $query="select Max(id) from specialite";
                $statement=$database->prepare($query);
                $statement->execute();
                $row=$statement->fetch();
                $id=$row['0'];
                $id++;
                
                
                $query="insert into specialite(id,label) values(:id,:label) ";
                $statement=$database->prepare($query);
                $statement->execute([
                    "id"=>$id,
                    "label"=>$label
                ]);                
               
                return $id;
        
            }catch (PDOException $e){        
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
                }
    
        }




}










?>