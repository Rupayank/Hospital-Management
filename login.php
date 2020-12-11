<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="login-wrap">
	<div class="login-html">
        <h2 style="text-align: center; font-weight:bolder; color:white;">Admin Login</h2>
		<!-- <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label> -->
        <!-- <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label> -->
        <form action="logincheck.php" method="POST">
		<div class="login-form">
			<!-- <div class="sign-in-htm"> -->
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
                    <!-- <span class="icon"></span> -->
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" name="submit">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="#forgot">Forgot Password?</a>
                </div>
                
			<!-- </div> -->
			<!-- <div class="sign-up-htm">
				<div class="group">
					<label for="user" class="label">Employee ID</label>
					<input id="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<label for="pass" class="label">Contact No.</label>
					<input id="pass" type="text" class="input">
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Registered?</a>
				</div>
			</div> -->
        </div>
        </form>
	</div>
</div>
</body>
</html>