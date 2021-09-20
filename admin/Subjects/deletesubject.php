<?php
    require_once("../../database/Subjects.php");
    $subjects = new Subjects();
    $classno = $_GET['classno'];
    $subject = $_GET['name'];
    $subjects->deleteSubject($classno, $subject);

    header("Location: " . $_SERVER['HTTP_REFERER']);
?>
