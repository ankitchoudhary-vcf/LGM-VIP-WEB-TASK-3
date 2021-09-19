<?php

    class Classes{

        function __construct()
        {
            require_once('Database_connection.php');
            $connection = new Database_connection;
            $this->connect = $connection->connect();
        }
        function getAllClasses(){
            $query = "SELECT * FROM classes";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        function getNumberOfClasses(){
            $query = "SELECT * FROM classes";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            return $statement->rowCount();
        }
        function addClass($classno){
            $query = "INSERT INTO classes (classno) VALUES (:classno)";
            $statement = $this->connect->prepare($query);
            $statement->bindParam(":classno", $classno, PDO::PARAM_STR);
            $statement->execute();
            return "Class Added Successfully";
        }
        function deleteClass($classno){
            $query = "DELETE FROM classes WHERE classno = :classno";
            $statement = $this->connect->prepare($query);
            $statement->bindParam(":classno", $classno, PDO::PARAM_STR);
            $statement->execute();
        }
    }
?>