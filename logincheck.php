<?php
session_start();
$con=mysqli_connect('localhost','root','','patientdb');
// if($con)
//     echo "Connected";
// else
//     echo "Error";
if(isset($_POST['submit']))
{
    $empname=$_POST['user'];
    $pass=$_POST['pass'];
    $query="select * from admin where user='$empname' && pass='$pass'";
    $run=mysqli_query($con,$query);
    $row=mysqli_num_rows($run);
    if($row==1){
        echo "Successfully signed in";
        $_SESSION['user']=$empname;
        header('location: dbms_index.php');
    }
    else{
        echo "Invalid username or password";
        header('location: login.php');
    }
}
?>