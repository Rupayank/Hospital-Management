<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
<?php require 'config.php' ?>
<?php require_once 'test.php';?>
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
  <form action="test.php" method="post">
  <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="form-row">
      <div class="form-group">
        <?php 
        $result=$con->query("SELECT * FROM labtest ORDER BY t_id DESC LIMIT 1") or die($con->error);
        $row=$result->fetch_assoc();
        ?>
        <label for="inputEmail4">Test ID</label>
        <input type="text" name="t_id" readonly class="form-control" value=<?php 
        if ($id>0){echo $id;}
        else if (empty($row['t_id'])){ echo 0;}
        else {echo $row['t_id']+1; }
        ?>>
        
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Test Name</label>
        <input type="text" name="t_name" required class="form-control" placeholder="Enter test name" id="inputEmail4" value="<?php echo $t_name; ?>" >
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Test result</label>
        <select id="inputState" name="t_result" class="form-control" required>
          <option value=<?php echo $t_result; ?>>Choose...</option>
          <option value="Positive">Positive</option>
          <option value="Negative">Negative</option>
          <option value="Normal">Normal</option>
          <option value="High">High</option>
          <option value="Low">Low</option>
          <option value="Other">Other</option>
        </select>
      </div>
    </div>
    <?php if ($update):    ?>
    <button type="submit" name="update" class="btn btn-warning">Update</button>
    <button type="submit" name="cancel" class="btn btn-dark">Cancel</button>
    <?php else:?>
    <button type="submit" name="add" class="btn btn-primary">Add</button>
    <?php endif; ?>
  </form>

<!-- display inserted table -->
<?php 
  $con = new mysqli('localhost','root','','patientdb') or die(mysqli_error($con));
  $result=$con->query("select * from labtest") or die($con->error);
?>

<!-- test table -->
<div class="container ">
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Test ID</th>
        <th scope="col">Test Name</th>
        <th scope="col">Test Result</th>
        <th scope="col">Test date</th>
        <th scope="col">Action</th>
      </tr>
    </thead>

    <!-- start of while loop for fetching -->
    <?php
      while($row=$result->fetch_assoc()):
    ?>

    <tbody>
      <tr>
        <td><?php echo $row['t_id']; ?></td>
        <td><?php echo $row['t_name']; ?></td>
        <td><?php echo $row['t_result']; ?></td>
        <td><?php echo $row['t_date']; ?></td>
        <td>
          <a href="dbms_tests.php?edit=<?php echo $row['t_id'];?>" class="btn btn-info">Edit</a>
          <a href="test.php?delete=<?php echo $row['t_id'];?>" class="btn btn-danger">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div> 
</body>
</html>