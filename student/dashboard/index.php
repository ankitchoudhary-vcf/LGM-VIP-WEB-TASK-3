<?php
include("../header.php");
require_once('../../database/Class.php');
require_once('../../database/Students.php');
?>

<body>
    <main class="admin">
        <div class="subjects">
            <div class="add-subject">
                <div class="title">
                    <?php
                        $students = new Students();
                        $name = $students->getStudentNameByClassnoAndrollno($_GET['classno'],$_GET['rollno']);
                        echo "Result of ". $name[0]['name'];
                    ?>
                </div>
                
                <div class="subjects-details" style="width: 80%;">
                    <div class="title">Total Marks</div>
                    <?php
                        require_once('../../database/Marks.php');
                        require_once('../../database/Subjects.php');
                        $marks = new Marks();
                        $subjects = new Subjects();
                        
                        $classno = $_GET['classno'];
                        $rollno = $_GET['rollno'];
                        
                        $numberofsubjects = $subjects->getNumberOfSubjects($classno);
                        $total = $marks->getTotalMarks($rollno, $classno);
                        $all = $numberofsubjects * 100;
                        echo "$total out of $all"

                    ?>
                </div>

                <div class="subjects-details" style="width: 80%;">
                    <div class="title">Percentage</div>
                    <?php         
                        echo $total / $numberofsubjects . " %";
                    ?>
                </div>

                <div class="subjects-details" style="width: 80%;">
                    <div class="title">Subject vise marks</div>

                    <?php
                        $data = $marks->getMarks($_GET['rollno'], $_GET['classno']);
                        foreach ($data as $row) {
                            echo "<div class='subjects-container'>";
                            echo "<div class='subject-item'>";
                            echo $row['subject'];
                            echo "</div>";
                            echo "<div class='subject-item'>";
                            echo '<strong>' . $row['marks'] . '</strong>';
                            echo "</div>";
                            echo "</div>";
                        }

                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

<?php
include('../footer.php');
?>