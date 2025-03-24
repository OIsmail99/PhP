<?php
require_once "connection_credentials.php";
require_once "connection.php";
class Database{
    private static $instance = null;

    private function __construct(){

    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Database();
        }
        return self::$instance;
    }


     function getUserById($id) {
        try {
            $conn = connect_to_db_pdo();
            $query = "SELECT * FROM users WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        } finally {
            $conn = null;
        }
    }
     function gettAllUsers(){
        $data = [];
        try{
            $conn  = connect_to_db_pdo();
            if($conn){
                $select_query = "select id, name, email, room from `users`";
                $stmt = $conn->prepare($select_query);
                $res=$stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_NUM);
    
                return $data;
            }
    
        }catch (Exception $e){
            displayError($e->getMessage());
        }
    
        return $data;
    }
    function insertData($name, $email, $password, $room, $image){

        try{
            $conn = connect_to_db_pdo();
            $insert_query = "INSERT INTO `users` (name, email, password, room, image_path) 
                            VALUES (:name, :email, :password, :room, :image_path)";
            
            $stmt = $conn->prepare($insert_query);
            
            
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':room', $room);
            $stmt->bindParam(':image_path', $image);
            $res=$stmt->execute();
            if($res){
                $inserted_id = $conn->lastInsertId();
                return $inserted_id;
            }
    
        }catch (PDOException $e){
            throw $e;
        }
        finally{
            $conn = null;
        }
    
        return false;
    }

    
    function deleteUser($id){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            try {
                $conn = connect_to_db_pdo();
        
                $delete_query = "DELETE FROM `users` WHERE id = :id";
        
                $stmt = $conn->prepare($delete_query);
                $stmt->bindParam(':id', $id);
        
                $res = $stmt->execute();
        
                return $res;
            } catch(PDOException $err){
                error_log($e->getMessage());
                return false;
            }
            finally{
                $conn = null;
                header("Location: ../app/table.php");
            }
        }
    }
    
    
    function editData($id, array $updateFields) {
        try {
            $conn = connect_to_db_pdo();
            
            if (empty($updateFields)) {
                throw new InvalidArgumentException("No fields provided for update");
            }
            
            $query = "UPDATE `users` SET ";
            
            
            $setParts = []; //will hold the set parts of the query
            foreach ($updateFields as $field => $value) {
                if (!in_array($field, ['name', 'email', 'password', 'room', 'image_path'])) {
                    throw new InvalidArgumentException("Invalid field name: $field");
                }
                $setParts[] = "$field = :$field";
            }
            
            $query .= implode(', ', $setParts);
            $query .= " WHERE id = :id";
            
            $stmt = $conn->prepare($query);
            
            foreach ($updateFields as $field => $value) {
                $stmt->bindValue(":$field", $value);
            }
            $stmt->bindParam(':id', $id);
            
            $res = $stmt->execute();
            
            return $res;
        } 
        catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
        finally {
            $conn = null;
        }
    }

    
}

?>