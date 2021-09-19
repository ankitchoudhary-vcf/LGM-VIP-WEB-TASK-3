<?php
    require_once("../../database/Students.php");
    $students = new Students();
    $id = $_GET['id'];
    $students->deleteStudent($id);
    header("Location: " . $_SERVER['HTTP_REFERER']);
?>
