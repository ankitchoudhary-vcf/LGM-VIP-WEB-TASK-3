<?php
session_start();
if(!(isset($_SESSION['username']))){
    header('location:/admin');
}
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
                <a class="menu-item active" href="/admin/students">
                    <i class="fa fa-users" aria-hidden="true"></i><span>Students</span>
                </a>
                <a class="menu-item" href="/admin/subjects">
                    <i class="fas fa-book"></i><span>Subjects</span>
                </a>
                <a class="menu-item" href="/admin/results">
                    <i class="fas fa-poll-h"></i><span>Results</span>
                </a>
                <a class="menu-item" href="/admin/logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i><span>Log Out</span>
                </a>
            </div>
        </nav>
        <div class="Students">
            <div class="add-student">
                <div class="title">Add Students</div>
                <div class="student-form">
                    <form method="post">
                        <div class="form-field">
                            <label for="" class="label">Name of Student</label>
                            <input type="text" class="input" placeholder="Enter Name" name="name" required>
                        </div>
                        <div class="form-field">
                            <label for="" class="label">Class</label>
                            <select name="classno" id="input" class="input">
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
                        <div class="form-field">
                            <label for="" class="label">Roll No.</label>
                            <input type="number" class="input" placeholder="Enter Name" name="rollno" required>
                        </div>
                        <div class="form-field">
                            <label for="" class="label">Gender</label>
                            <select name="gender" id="" class="input">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                            <div class="form-field">
                                <label for="" class="label">Age</label>
                                <input type="number" class="input" placeholder="Enter Name" name="age" required>
                            </div>
                            <div class="form-field">
                                <button name="submit" class="button is-success">
                                    Add
                                </button>
                            </div>
                    </form>
                </div>
                <?php
                    $message = '';
                    if(isset($_POST['submit'])){
                        $name = $_POST['name'];
                        $classno = $_POST['classno'];
                        $rollno = $_POST['rollno'];
                        $age = $_POST['age'];
                        $gender = $_POST['gender'];

                        $message = $students->addStudent($name, $classno, $rollno, $age, $gender);
                    }
                    echo $message;    
                ?>
            </div>
            <div class="Students-details">
                <div class="title">Available Students</div>
                <div class="students-details-container">
                <div class='student-container header'>
                    <div class="student-item"><Strong>Name</Strong></div>
                    <div class="student-item"><strong>Class</strong></div>
                    <div class="student-item"><strong>Action </strong></div>
                </div>
                <?php
                    $data = $students->getAllStudents();
                    foreach($data as $row){
                        echo "<div class='student-container'>";
                        echo "<div class='student-item'>";
                        echo $row['name'];
                        echo "</div>";
                        echo "<div class='student-item'>";
                        echo $row['classno'];
                        echo "</div>";
                        echo "<div class='student-item'>";
                        echo "<button class='trash-button' onclick='window.location.href=\"/admin/students/deletestudent.php?id=".$row['id']."\"'> <i class='fas fa-trash-alt'></i></button>";
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