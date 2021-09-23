<?php
session_start();

if(isset($_SESSION['username']))
{
    session_unset();
    header('location:/');
}
else{
    header('location:/admin');
}
?>