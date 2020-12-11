<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Brand</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dbms_index.php">Registration<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dbms_tests.php">Tests</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dbms_doctor.php">Doctors</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dbms_billing.php">Billing</a>
      </li>
      </li>
    </ul>
  </div>
</nav>

<?php require_once 'doctor.php';?>
<?php
  if(isset($_SESSION['message'])):  ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>
<div class="container col-6 mt-5">
  <form action="Doctor.php" method="post">
  <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="form-row">
      <div class="form-group">
        <?php 
        $result=$con->query("SELECT * FROM doctordata ORDER BY d_id DESC LIMIT 1") or die($con->error);
        $row=$result->fetch_assoc();
        ?>
        <label for="inputEmail4">Doctor ID</label>
        <input type="text" name="d_id" readonly class="form-control" value=<?php if (empty($row['d_id'])){ echo 0;}
        else {echo $row['d_id']+1; }?>>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Doctor Name</label>
        <input type="text" name="d_name" required class="form-control" placeholder="Enter doctor name" id="inputEmail4" value="<?php echo $d_name; ?>" >
      </div>
      <div class="form-group col-md-6">
        <label for="inputEmail4">Doctor Specialisation</label>
        <input type="text" name="d_spcl" required class="form-control" placeholder="Enter doctor specialisation" id="inputEmail4" value=<?php echo $d_spcl; ?> >
      </div>
    </div>
    <?php if ($update):    ?>
    <button type="submit" name="update" class="btn btn-warning">Update</button>
    <?php else:?>
    <button type="submit" name="add" class="btn btn-primary">Add</button>
    <?php endif; ?>
  </form>

<!-- display inserted table -->
<?php 
  $con = new mysqli('localhost','root','','patientdb') or die(mysqli_error($con));
  $result=$con->query("select * from doctordata") or die($con->error);
?>

<!-- Doctor table -->
<div class="container ">
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Doctor ID</th>
        <th scope="col">Doctor Name</th>
        <th scope="col">Specialisation</th>
        <!-- <th scope="col">Patient id</th> -->
        <!-- <th scope="col">Doctor date</th> -->
        <th scope="col">Action</th>
      </tr>
    </thead>

    <!-- start of while loop for fetching -->
    <?php
      while($row=$result->fetch_assoc()):
    ?>

    <tbody>
      <tr>
        <td><?php echo $row['d_id']; ?></td>
        <td><?php echo $row['d_name']; ?></td>
        <!-- <td><?php //echo $row['p_id']; ?></td> -->
        <td><?php echo $row['d_spcl']; ?></td>
        <td>
          <a href="dbms_doctor.php?edit=<?php echo $row['d_id'];?>" class="btn btn-info">Edit</a>
          <a href="doctor.php?delete=<?php echo $row['d_id'];?>" class="btn btn-danger">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div> 
</body>
</html>