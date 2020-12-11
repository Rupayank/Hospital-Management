<!-- patient data insertion -->
<?php

    session_start();
    $con=mysqli_connect('localhost','root','','patientdb');

    $update=false;
    $id=0;
    $pname= '';
    $contact= '';
    $pgender= '';
    $p_age= '';
    $p_address= '';

    if(isset($_POST['register'])){
        $pname= ucwords($_POST['pname']);
        $contact= $_POST['contact'];
        $pgender= ucwords($_POST['pgender']);
        $p_age= ($_POST['p_age']);
        $p_address= ucwords($_POST['p_address']);

        $query="INSERT INTO `patientdata`( `name`, `contact`, `gender`, `age`, `address`) VALUES ('$pname','$contact','$pgender','$p_age','$p_address')";
        $run=mysqli_query($con,$query);

        $_SESSION['message']="Record has been saved";
        $_SESSION['msg_type']="success";

        header("location: dbms_index.php");
    }
    
    if(isset($_GET['delete'])){
        $pid=$_GET['delete'];
        $con->query("delete from patientdata where pid=$pid") or die($con->error());
        
        $_SESSION['message']="Record has been deleted";
        $_SESSION['msg_type']="danger";

        header("location: dbms_index.php");
    }

    if(isset($_GET['edit']))
    {
        $pid=$_GET['edit'];
        $update=true;
        $result=$con->query("select * from patientdata where pid=$pid") or die($con->error());
        if($result){
            $row=$result->fetch_array();
            $pname= $row['name'];
            $contact= $row['contact'];
            $pgender= $row['gender'];
            $p_age= $row['age'];
            $p_address= $row['address'];

        }
    }
    if(isset($_POST['update']))
    {
        $id=$_POST['id'];
        $pname= ucwords($_POST['pname']);
        $contact= $_POST['contact'];
        $pgender= ucwords($_POST['pgender']);
        $p_age= ($_POST['p_age']);
        $p_address= ucwords($_POST['p_address']);

        $con->query("update patientdata set name='$pname', contact='$contact', gender='$pgender', age='$p_age', address='$p_address'") or die($con->error());
        $_SESSION['message']="Record has been updated";
        $_SESSION['msg_type']="warning";

        header("location: dbms_index.php");

    }
?>