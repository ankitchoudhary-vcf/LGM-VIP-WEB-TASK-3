<?php
    class Subjects{
        function __construct(){
            require_once('Database_connection.php');
            $connection = new Database_connection;
            $this->connect = $connection->connect();
        }
        function getSubjects(){
            $query = "SELECT * FROM Subjects";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        function getSubjectsInClass($classno){
            $query = "SELECT * FROM Subjects WHERE ClassNo = :classno";
            $statement = $this->connect->prepare($query);
            $statement->bindParam(":classno", $classno, PDO::PARAM_INT);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        function getNumberOfSubjects(){
            $query = "SELECT name FROM Subjects";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            return $statement->rowCount();
        }
        function addSubject($classno, $name){
            $query = "INSERT INTO Subjects (ClassNo, Name) VALUES ('$classno', '$name')";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            return "Subject $name added success fully in class $classno";
        }
        function deleteSubject($classno, $name){
            $query = "DELETE FROM Subjects WHERE ClassNo = '$classno' AND Name = '$name'";
            $statement = $this->connect->prepare($query);
            $statement->execute();
        }
    }