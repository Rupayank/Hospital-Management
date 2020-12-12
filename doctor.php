<?php
    session_start();
    $con=mysqli_connect('localhost','root','','patientdb');

    $update=false;
    $id=0;
    $d_name= '';
    $d_spcl= '';

    if(isset($_POST['add']))
    {
        $d_name= ucwords($_POST['d_name']);
        $d_spcl= ucwords($_POST['d_spcl']);

        $query="INSERT INTO `doctordata`(`d_name`, `d_spcl`) VALUES ('$d_name','$d_spcl')";
        $run =mysqli_query($con,$query);

        $_SESSION['message']="Record has been saved";
        $_SESSION['msg_type']="success";

        header("location: dbms_doctor.php");
    }
    
    if(isset($_GET['delete'])){
        $d_id=$_GET['delete'];
        $con->query("delete from doctordata where d_id=$d_id") or die($con->error());
        
        $_SESSION['message']="Record has been deleted";
        $_SESSION['msg_type']="danger";

        header("location: dbms_doctor.php");
    }

    if(isset($_GET['edit']))
    {
        $d_id=$_GET['edit'];
        $update=true;
        $result=$con->query("select * from doctordata where d_id=$d_id") or die($con->error());
        if($result){
            $row=$result->fetch_array();
            $id=$row['d_id'];
            $d_name= $row['d_name'];
            $d_spcl= $row['d_spcl'];
        }
    }

    if(isset($_POST['update']))
    {
        $id=$_POST['id'];
        $d_name= ucwords($_POST['d_name']);
        $d_spcl= ucwords($_POST['d_spcl']);

        $con->query("update doctordata set d_name='$d_name',d_spcl='$d_spcl' where d_id='$id'") or die($con->error());
        $_SESSION['message']="Record has been updated";
        $_SESSION['msg_type']="warning";

        header("location: dbms_doctor.php");

    }
    if(isset($_POST['cancel']))
    {
        $id=0;
        $d_name="";
        $d_spcl= "";
        $_SESSION['message']="Update canceled";
        $_SESSION['msg_type']="dark";

        header("location: dbms_doctor.php");
    }
?>