<?php
include("./header.php");

if (isset($_POST['check'])) {
    $classno=$_POST['classno'];
    $rollno = $_POST['rollno'];
    header('location:/student/dashboard/?classno='.$classno.'&rollno='.$rollno.'');
}
?>

<body>
    <main class="login">
        <div class="login-admin-card">
            <img src="/assets/img/login.png">
            <form class="login-form" method="post">
                <img src="/assets/img/Student_profile.png">
                <div class="form-field">
                    <select name="classno" required>
                        <option value="Select Class">Select Class</option>
                        <?php 
                            require_once('../database/Class.php');
                            require_once('../database/Students.php');
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
                    <input type="number" name="rollno" placeholder="Roll no" required>
                </div>
                <div class="form-field">
                    <button type="submit" name="check">Check Result</button>
                </div>
            </form>
        </div>
    </main>
</body>

<?php
include('./footer.php');
?>