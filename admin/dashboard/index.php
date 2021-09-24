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
                <a class="menu-item active" href="/admin/dashboard">
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
                <a class="menu-item" href="/admin/results">
                    <i class="fas fa-poll-h"></i><span>Results</span>
                </a>
                <a class="menu-item" href="/admin/logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i><span>Log Out</span>
                </a>
           </div>
        </nav>
        <div class="dashboard-main">
            <div class="counter-card">
                <div class="vertical-line"></div>
                <div>
                    <div class="title">
                        Total Classes
                    </div>
                    <div class="count">
                    <?php
                        require_once('../../database/HomeData.php');
                        $homeData = new HomeData();
                        $data = $homeData->getNumberOfClasses();
                        echo $data;
                    ?>
                    </div>
                </div>
            </div>
            <div class="counter-card">
                <div class="vertical-line"></div>
                <div>
                    <div class="title">
                        Total Subjects
                    </div>
                    <div class="count">
                    <?php
                        $data = $homeData->getNumberOfSubjects();
                        echo $data;
                    ?>
                    </div>
                </div>
            </div>
            <div class="counter-card">
                <div class="vertical-line"></div>
                <div>
                    <div class="title">
                        Total Students
                    </div>
                    <div class="count">
                    <?php
                        $data = $homeData->getNumberOfStudents();
                        echo $data;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<?php
include('../footer.php');
?>