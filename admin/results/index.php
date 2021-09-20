<?php
include("../header.php");
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
                <div class="title">Select a class</div>
                <div class="subject-form">
                    <form method="post">
                        <div class="form-field">
                            <label for="">Class</label>
                            <select name="classno" id="input">
                                <option value="">Select Class</option>
                                <?php
                                require_once('../../database/Class.php');
                                require_once('../../database/Students.php');
                                $classes = new Classes();
                                $students = new Students();
                                $data = $classes->getAllClasses();
                                foreach ($data as $class) {
                                    echo "<option value='" . $class['classno'] . "'>" . $class['classno'] . "</option>";
                                }

                                ?>
                            </select>
                        </div>

                        <br>
                        <div class="form-field">
                            <button name="submit">
                                List Students
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="subjects-details">
                <div class="title">Availble Students</div>
                <div class="subject-details-container">
                <div class='subjects-container header'>
                    <div class="subject-item"><Strong>Name</Strong></div>
                    <div class="subject-item"><strong>Roll No</strong></div>
                    <div class="subject-item"><strong>Action </strong></div>
                </div>
                <?php
                    if (isset($_POST['submit'])) {
                        $classno = $_POST['classno'];
                        $data = $students->getStudentByClassno($classno);
                        foreach ($data as $row) {
                            echo "<div class='subjects-container'>";
                            echo "<div class='subject-item'>";
                            echo $row['name'];
                            echo "</div>";
                            echo "<div class='subject-item'>";
                            echo $row['rollno'];
                            echo "</div>";
                            echo "<div class='subject-item'>";
                            echo "<span>
                            <button class='success-btn' onclick='window.location.href=\"/admin/results/peek.php?id=" . $row['id'] .  "&rollno=".$row['rollno']."&classno=".$row['classno']."\"'><i class='far fa-eye'></i></button>
                            <button class='update-btn' onclick='window.location.href=\"/admin/results/updateresult.php?id=" . $row['id'] .  "&rollno=".$row['rollno']."&classno=".$row['classno']."\"'><i class='far fa-edit'></i></button>
                            </span>";
                            echo "</div>";
                            echo "</div>";
                        }
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