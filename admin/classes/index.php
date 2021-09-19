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
                <a class="menu-item active" href="/admin/classes">
                    <i class="fas fa-archway"></i><span>Classes</span>
                </a>
                <a class="menu-item" href="/admin/students">
                    <i class="fa fa-users" aria-hidden="true"></i><span>Students</span>
                </a>
                <a class="menu-item" href="/admin/results">
                    <i class="fas fa-poll-h"></i><span>Results</span>
                </a>
                <a class="menu-item" href="/admin/logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i><span>Log Out</span>
                </a>
           </div>
        </nav>
            <div class="classes">
                <div class="add-class">
                    <div class="title">Add Class</div>
                    <div>
                        <form method="post">
                        <div class="form-field">
                            <label for="" class="label">Class No.</label>
                            <input type="number" class="input" placeholder="eg: 4, 7 etc" name="class" required>
                        </div>
                        <br>
                        <div class="form-field">
                            <button name="submit" class="button is-success">
                                Add
                            </button>
                        </div>
                        </form>
                    </div>
                    <?php
                        $message = "";
                        include("../../database/Class.php");
                        $classes = new Classes();
                        if(isset($_POST['submit'])){
                            $classnumber = $_POST['class'];
                            $message = $classes->addClass($classnumber);
                        }
                        echo $message;    
                    ?>
                </div>
                <div class="class-details">
                    <div class="title">Available Classes</div>
                    <div class="classes-container">
                    <?php
                        $data = $classes->getAllClasses();
                        foreach($data as $row){
                            echo "<div class='class-container'>";
                            echo "<div class='class-item'>";
                            echo $row['classno'];
                            echo "</div>";
                            echo "<div class='class-item'>";
                            echo "<button class='trash-button' onclick='window.location.href=\"/admin/classes/deleteclass.php?classno=".$row['classno']."\"'> <i class='fas fa-trash-alt'></i>Delete</button>";
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