<?php
session_start();

if(!isset($_SESSION['name'] )){
    header("Location: ../login.php");

}
include '../oop/user.php';
$user = new User();
$id = $_REQUEST['id'];
$delete = $user->deleteUser($id);
// header("Location: activity.php");
?>