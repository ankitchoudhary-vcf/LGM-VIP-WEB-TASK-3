<?php

class Marks{
    function __construct()
    {
        require_once('Database_connection.php');
        $connection = new Database_connection;
        $this->connect = $connection->connect();
    }
    function getMarks($rollno, $classno){
        $query = "SELECT subject, marks FROM marks WHERE rollno=:rollno AND classno=:classno";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":rollno",$rollno);
        $stmt->bindParam(":classno",$classno);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    function insertMarks($classno, $rollno, $subject, $marks){
        //delete the marks for the student for rollno classno and subject   
        $query = "DELETE FROM marks WHERE rollno=:rollno AND classno=:classno AND subject=:subject";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":rollno",$rollno);
        $stmt->bindParam(":classno",$classno);
        $stmt->bindParam(":subject",$subject);
        $stmt->execute();

        //now insert the new marks
        $query = "INSERT INTO marks(classno, rollno, subject, marks) VALUES(:classno, :rollno, :subject, :marks)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":classno",$classno);
        $stmt->bindParam(":rollno",$rollno);
        $stmt->bindParam(":subject",$subject);
        $stmt->bindParam(":marks",$marks);
        $stmt->execute();
    }

    // get total marks for a student with rollno and classno
    function getTotalMarks($rollno, $classno){
        $query = "SELECT sum(marks) as total FROM marks WHERE rollno=:rollno AND classno=:classno";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(":rollno",$rollno);
        $stmt->bindParam(":classno",$classno);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    //Queries that could be used

    // function updateMarks($classno, $rollno, $subject, $marks){
    //     $query = "UPDATE marks SET marks=:marks WHERE classno=:classno AND rollno=:rollno AND subject=:subject";
    //     $stmt = $this->connect->prepare($query);
    //     $stmt->bindParam(":classno",$classno);
    //     $stmt->bindParam(":rollno",$rollno);
    //     $stmt->bindParam(":subject",$subject);
    //     $stmt->bindParam(":marks",$marks);
    //     $stmt->execute();
    // }
    // function checkifMarksExists($classno, $rollno, $subject){
    //     $query = "SELECT * FROM marks WHERE classno=:classno AND rollno=:rollno AND subject=:subject";
    //     $stmt = $this->connect->prepare($query);
    //     $stmt->bindParam(":classno",$classno);
    //     $stmt->bindParam(":rollno",$rollno);
    //     $stmt->bindParam(":subject",$subject);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll();
    //     if(count($result)>0){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
}

?>