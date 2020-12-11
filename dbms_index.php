<?php require_once 'register.php';?>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
  <!-- <div class="collapse navbar-collapse" id="navbarNav">
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
      <li class="nav-item mr-5">
        <a class="nav-link" href="dbms_billing.php">Billing</a>
      </li>
      <ul class="navbar-nav my-lg-0 mr-3">
            <li class="nav-item">Hi <?php //echo ucwords($_SESSION['user']);?></li>
            <li><a class="nav-link" href="logout.php">Logout</a></li>
      </ul> -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Apollo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
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
    </ul>
    <ul class="navbar-nav my-2 my-lg-0">
      <li class="nav-item nav-link mr-2">Hi <?php echo ucwords($_SESSION['user']);?></li>
      <li><a class="nav-link text-white bg-danger" href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<?php
  if(isset($_SESSION['message'])):  ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
  <?php endif ?>

<!-- form part -->

<div class="container col-5 mt-5">
  <form action="register.php" method="post">
  <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="form-row">
      <div class="form-group">
      <?php 
      $result=$con->query("SELECT * FROM patientdata ORDER BY pid DESC LIMIT 1") or die($con->error);
      $row=$result->fetch_assoc();
      ?>
        <label for="inputEmail4">Patient ID</label>
        <input type="text" name="pid" readonly class="form-control" value=<?php if (empty($row['pid'])){ echo 0;}
        else {echo $row['pid']+1; }?>>
      </div>
    </div>
      <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Patient Name</label>
        <input type="text" name="pname" required class="form-control" placeholder="Enter full name" id="inputEmail4" value="<?php echo $pname; ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Contact No.</label>
        <input type="number" name="contact" min="1111111111" max="9999999999" required class="form-control" placeholder="10 digit mobile number" id="inputPassword4" value=<?php echo $contact; ?>>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Gender</label>
        <select id="inputState" name="pgender" class="form-control" required>
          <option value=<?php echo $pgender; ?>>Choose...</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Age</label>
        <input type="number" max="100" name="p_age" required class="form-control" placeholder="Enter age" id="inputPassword4" value=<?php echo $p_age; ?>>
      </div>
    </div>
    <div class="form-group">
      <label for="inputAddress">Address</label>
      <input type="text" max="50" name="p_address" required class="form-control" id="inputAddress" placeholder="Eg: 1234 Main St" value="<?php echo $p_address; ?>">
    </div>
    <?php if ($update):    ?>
    <button type="submit" name="update" class="btn btn-warning">Update</button>
    <?php else:?>
    <button type="submit" name="register" class="btn btn-primary">Register</button>
    <?php endif; ?>
  </form>
</div>


<!-- inserted table display -->
<?php 
  $con = new mysqli('localhost','root','','patientdb') or die(mysqli_error($con));
  $result=$con->query("select * from patientdata") or die($con->error);
 
  // $result->fetch_assoc();
  // pre($result->fetch_assoc());
//   function pre($array){
//     echo '<pre>';
//     print_r($array);
//     echo '</pre';
//    }
?>


<!-- whole table -->
<div class="container ">
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Patient Id</th>
        <th scope="col">Patient Name</th>
        <th scope="col">Gender</th>
        <th scope="col">Age</th>
        <th scope="col">Contact No.</th>
        <th scope="col">Action</th>
      </tr>
    </thead>

    <!-- start of while loop for fetching -->
    <?php
      while($row=$result->fetch_assoc()):
    ?>

    <tbody>
      <tr>
        <td><?php echo $row['pid']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td><?php echo $row['contact']; ?></td>
        <td>
          <a href="dbms_index.php?edit=<?php echo $row['pid'];?>" class="btn btn-info">Edit</a>
          <a href="register.php?delete=<?php echo $row['pid'];?>" class="btn btn-danger">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>