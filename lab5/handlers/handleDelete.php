<?php
require_once "../DB/dbOperations.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $db = Database::getInstance();
    $db->deleteUser($id);
}
?>