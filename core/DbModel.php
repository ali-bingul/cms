<?php
namespace app\core;

use app\model\Member;
use PDO;

abstract class DbModel extends Model{

        abstract public static function tableName(): string;
        abstract public function attributes(): array;
        abstract public static function primaryKey(): string;
        
        // save data to database
        public function save(){
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => ":$attr", $attributes);
            $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
            VALUES (".implode(',', $params).")");
            
            foreach($attributes as $attribute){
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            
            $statement->execute();
            return true;
        }
        
        public function update($where){
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
            $statement = self::prepare("UPDATE $tableName SET " . implode(',', $params) . $where);
            foreach($attributes as $attribute){
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
            $statement->execute();
            return true;
        }

        public static function prepare($sql){
            return Application::$app->db->pdo->prepare($sql);
        }

        // use filters that get from parameters and return matched row as an object
        public static function findOne($where, $class){
            $tableName = $class::tableName();
            $attributes = array_keys($where);
            $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach($where as $key => $item){
                $statement->bindValue(":$key", $item);
            }
            $statement->execute();
            return $statement->fetchObject(static::class);
        }

        public static function getAll($class, $where = '',  $orderBy = '', $limit = ''){
            $tableName = $class::tableName();
            $statement = self::prepare("SELECT * FROM $tableName" . $where . $orderBy . $limit);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public static function getAllWithFilter($class, $where){
            $tableName = $class::tableName();
            $attributes = array_keys($where);
            $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach($where as $key => $item){
                $statement->bindValue(":$key", $item);
            }
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public static function deleteOne($where, $class){
            $tableName = $class::tableName();
            $attributes = array_keys($where);
            $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("DELETE FROM $tableName WHERE $sql");
            foreach($where as $key => $value){
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();
        }
        
        
        public static function updateWhere($where, $class, $isActive){
            $tableName = $class::tableName();
            $attributes = array_keys($where);
            $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("UPDATE $tableName SET active = $isActive WHERE $sql");
            foreach($where as $key => $value){
                $statement->bindValue(":$key", $value);
            }
            $statement->execute();
        }
        
        public static function uploadImage($class, $where){
            $tableName = $class::tableName();
            $targetDir = Application::$ROOT_DIR . "/public/uploads/";
            $attributes = array_keys($where);
            $sqlw = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $fileName = basename($_FILES['image']["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
            if(isset($_POST["submit"]) && !empty($_FILES["image"]["name"])){
                $allowTypes = array('jpg', 'png', 'jpeg', 'PNG');
                if(in_array($fileType, $allowTypes)){
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                        $sql = "UPDATE $tableName SET image = '$fileName' WHERE $sqlw";
                        $statement = self::prepare($sql);
                        foreach($where as $key => $value){
                            $statement->bindValue(":$key", $value);
                        }
                        $insert = $statement->execute();
                        return true;
                    }
                }
            }
        }

        public function uploadComment($class, $where){
            // $tableName = $class::tableName();
            // $attributes = array_keys($where);
            // $sqlw = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            // if(isset($_POST['submit'])){
            //     $sql = sprintf("UPDATE $tableName SET member_id = %s, post_title = %s WHERE $sqlw",
            //     $_SESSION['member'],
            //     substr($_SERVER['REQUEST_URI'], 5)
            //     );
            //     $statement = self::prepare($sql);
            //     foreach($where as $key => $value){
            //         $statement->bindValue(":$key", $value);
            //     }
            //     $insert = $statement->execute();
            //     return true;
            // }



            // $tableName = $class::tableName();
            // $attributes = $this->attributes();
            // $params = array_map(fn($attr) => ":$attr", $attributes);
            // $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
            //                             VALUES (".implode(',', $params).")");

            // $attributes[] = 'member_id';
            // $attributes[] = 'post_title';
            // $attr = implode(',', $attributes);
            // $values = implode(',', $params);
            // $statement = self::prepare(sprintf('INSERT INTO %s %s,member_id,post_title  VALUES %s,%s,%s', $tableName, $attr, $values, $_SESSION['member'], substr($_SERVER['REQUEST_URI'], 5)));

            // foreach($attributes as $attribute){
            //     $statement->bindValue(":$attribute", $this->{$attribute});
            // }

            // $statement->execute();
            // return true;
        }

        
    }
