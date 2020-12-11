<?php require_once 'logincheck.php';?>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
  if(!isset($_SESSION['message'])==false):  ?>
  <div id ="alert" class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>

<div class="login-wrap">
	<div class="login-html">
        <h2 style="text-align: center; font-weight:bolder; color:white;">Admin Login</h2>
        <form action="logincheck.php" method="POST">
		<div class="login-form">
				<div class="group">
					<label for="user" class="label">Employee name</label>
					<input id="user" type="text" class="input" name="user" autocomplete="off">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" name="pass" data-type="password" autocomplete="off">
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
                    <label for="check"> Keep me Signed in</label>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" name="submit">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
                </div>
        </div>
        </form>
	</div>
</div>
</body>
</html>