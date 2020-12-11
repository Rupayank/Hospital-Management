<?php
session_start();
$con=mysqli_connect('localhost','root','','patientdb');
if(isset($_POST['submit']))
{
    $empname=$_POST['user'];
    $pass=$_POST['pass'];
    $query="select * from admin where user='$empname' && pass='$pass'";
    $run=mysqli_query($con,$query);
    $row=mysqli_num_rows($run);
    if($row==1){
        $_SESSION['user']=$empname;
        header('location: dbms_index.php');
    }
    else{
        $_SESSION['message']="Invalid username or password";
        $_SESSION['msg_type']="danger";
        header('location: login.php');
    }
}
?>