<?php

class HomeData{
    function __construct(){
        require_once('Database_connection.php');
        $connection = new Database_connection;
        $this->connect = $connection->connect();
    }
    public function getNumberOfClasses(){
        $query = "SELECT COUNT(*) FROM classes";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }
    public function getNumberOfStudents(){
        $query = "SELECT COUNT(*) FROM students";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }
    public function getNumberOfSubjects(){
        $query = "SELECT COUNT(*) FROM subjects";
        $stmt = $this->connect->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }
    
    
}
?>