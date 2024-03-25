<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    if(isset($_GET['del'])) {
        $id = $_GET['del'];
        $query = mysqli_query($bd, "delete from users where id='$id'");
        if($query) {
            $_SESSION['delmsg']="User deleted successfully";
        } else {
            $_SESSION['delmsg']="Error deleting user";
        }
        header('location:manage-users.php');
    }
}
?>
