<?php
include("../header.php");
require_once('../../database/Class.php');
require_once('../../database/Students.php');
?>

<body>
    <main class="admin">
        <nav>
            <a class="navbar-title">
                <i class="fas fa-address-card"></i><span>SMS</span>
            </a>

            <div class="navbar-menu">
                <a class="menu-item" href="/admin/dashboard">
                    <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
                <a class="menu-item" href="/admin/classes">
                    <i class="fas fa-archway"></i><span>Classes</span>
                </a>
                <a class="menu-item" href="/admin/students">
                    <i class="fa fa-users" aria-hidden="true"></i><span>Students</span>
                </a>
                <a class="menu-item" href="/admin/subjects">
                    <i class="fas fa-book"></i><span>Subjects</span>
                </a>
                <a class="menu-item  active" href="/admin/results">
                    <i class="fas fa-poll-h"></i><span>Results</span>
                </a>
                <a class="menu-item" href="/admin/logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i><span>Log Out</span>
                </a>
            </div>
        </nav>
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