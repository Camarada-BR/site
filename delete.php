<?php
    include 'database.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE from `suspects` where id=$id";
        $conn->query($sql);
    }
    header('location:list.php');
    exit;
?>