<?php
require_once "../DB/db_operations.php";
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
?>