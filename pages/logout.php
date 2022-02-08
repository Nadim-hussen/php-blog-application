<?php
if(!isset($_SESSION['name'] )){
    session_start();
    // session_unset();
    session_destroy();

    header("Location: ../login.php");
}else{
    header("Location: ../login.php");
}
?>