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
                <a class="menu-item" href="/admin/students">
                    <i class="fa fa-users" aria-hidden="true"></i><span>Students</span>
                </a>
                <a class="menu-item active" href="/admin/subjects">
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
        <div class="subjects">
            <div class="add-subject">
                <div class="title">Add Subject</div>
                <div class="subject-form">
                    <form method="post">
                        <div class="form-field">
                            <label for="" >Class No.</label>
                            <select name="class" id="class">
                                <option value="">Select Class</option>
                                <?php
                                    require_once("../../database/Class.php");
                                    require_once("../../database/Subjects.php");
                                    $classes = new Classes();
                                    $subjects = new Subjects;
                                    $data = $classes->getAllClasses();
                                    foreach($data as $row)
                                    {
                                        echo "<option value='".$row['classno']."'>".$row['classno']."</option>";
                                    }
                                ?>    
                            </select>
                        </div>
                        <div class="form-field">
                            <label for="">Subject Name</label>
                            <input type="text" name="subject" id="subject" placeholder="Subject Name">
                        </div>
                        <div class="form-field">
                            <button name="submit">
                                Add
                            </button>
                        </div>
                    </form>
                    <?php
                        if(isset($_POST['submit']))
                        {
                            $message = "";
                            $class = $_POST['class'];
                            $subject = $_POST['subject'];
                            $message = $subjects->addSubject($class, $subject);
                            echo $message;
                        }
                    ?>
                </div>
            </div>
            <div class="subjects-details">
                <div class="title">Available Subjects</div>
                <div class="subject-details-container">
                <div class='subjects-container header'>
                    <div class="subject-item"><Strong>Subject</Strong></div>
                    <div class="subject-item"><strong>Class</strong></div>
                    <div class="subject-item"><strong>Action</strong></div>
                </div>
                <?php
                    $data =$subjects->getSubjects();
                    foreach($data as $row)
                    {
                        echo "<div class='subjects-container'>";
                        echo "<div class='subject-item'>";
                        echo $row['name'];
                        echo "</div>";
                        echo "<div class='subject-item'>";
                        echo $row['classno'];
                        echo "</div>";
                        echo "<div class='subject-item'>";
                        echo "<button class='trash-button' onclick='window.location.href=\"/admin/subjects/deletesubject.php?classno=".$row['classno']."&name=".$row['name']."\"'><i class='fas fa-trash-alt'></i></button>";
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