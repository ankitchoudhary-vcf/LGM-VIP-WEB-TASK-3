<?php
include("./header.php");
?>

<?php
    require('../database/Database_connection.php');

    session_start();
    $connection = new Database_connection;

    if(isset($_SESSION['username'])){
        header('location:./dashboard');
    }

    if(isset($_POST['login'])){
        $username = $_POST['email'];
        $password = $_POST['password'];

        if($username=="admin@gmail.com" && $password=="password"){
            $_SESSION['username'] = $username;
            header('location:./dashboard');
        }
    }
?>

<body>
    <main class="login">
        <div class="login-admin-card">
            <img src="/assets/img/login.png">
            <form class="login-form" method="POST">
                <img src="/assets/img/admin_profile.png">
                <div class="form-field">
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="form-field">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <div class="form-field">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </main>
</body>

<?php
include('./footer.php');
?>