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
                <div class="title">Update Result</div>
                <div class="subject-form">
                    <form action="" method="post">
                        <div class="title">
                            <label for="">Subjects</label>
                        </div>
                            <?php
                            require_once('../../database/Subjects.php');
                            require_once('../../database/Marks.php');
                            $classes = new Classes();
                            $students = new Students();
                            $subjects = new Subjects();
                            $marks = new Marks();
                            $clasno = $_GET['classno'];
                            $data = $subjects->getSubjectsInClass($clasno);
                            foreach ($data as $row) {
                                echo '<div class="form-field"><label>Enter Marks of ' . $row['name'] . '</label><input  type="number" value="" name="' . $row['name'] . '"/></div>';
                            }

                            if (isset($_POST['submit'])) {
                                foreach ($_POST as $key => $value) {
                                    if ($key != 'submit') {
                                        $marks->insertMarks($_GET['classno'], $_GET['rollno'], $key, $value);
                                    }
                                }
                            }

                            ?>

                        <br>
                        <div class="form-field">
                            <button name="submit">
                                Update Result
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="subjects-details">
                <div class="title">Previous Result</div>
                <div class="subject-details-container">
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