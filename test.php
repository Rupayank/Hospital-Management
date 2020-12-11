<?php
    session_start();
    $con=mysqli_connect('localhost','root','','patientdb');

    $update=false;
    $id=0;
    $t_name= '';
    $t_status= '';

    if(isset($_POST['add']))
    {
        $t_name= ucwords($_POST['t_name']);
        $t_status= $_POST['t_status'];

        $query="INSERT INTO `labtest`(`t_name`, `t_result`) VALUES ('$t_name','$t_status')";
        $run =mysqli_query($con,$query);

        $_SESSION['message']="Record has been saved";
        $_SESSION['msg_type']="success";

        header("location: dbms_tests.php");
    }
    
    if(isset($_GET['delete'])){
        $t_id=$_GET['delete'];
        $con->query("delete from labtest where t_id=$t_id") or die($con->error());
        
        $_SESSION['message']="Record has been deleted";
        $_SESSION['msg_type']="danger";

        header("location: dbms_tests.php");
    }

    if(isset($_GET['edit']))
    {
        $t_id=$_GET['edit'];
        $update=true;
        $result=$con->query("select * from labtest where t_id=$t_id") or die($con->error());
        if($result){
            $row=$result->fetch_array();
            $t_name= $row['t_name'];
            $t_status= $row['t_status'];
        }
    }

    if(isset($_POST['update']))
    {
        $id=$_POST['id'];
        $t_name= ($_POST['t_name']);
        $t_status= ($_POST['t_status']);

        $con->query("update labtest set t_name='$t_name',t_status='$t_status'") or die($con->error());
        $_SESSION['message']="Record has been updated";
        $_SESSION['msg_type']="warning";

        header("location: dbms_tests.php");

    }
?>