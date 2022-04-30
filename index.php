<?php

	if (isset($_SESSION['username'])){
		header("Location: actions.php");
	}

	else {
		test();
	}

	function test() {
		if (isset ($_POST["login"])) {
			$username = $_POST["user"];
			$password = $_POST["pass"];
	
			$validated = validate($username, $password);
			run_login();
	
			if ($validated == TRUE) {
				session_start();
				$_SESSION["username"] = $username;
				header("Location: actions.php");
			}

			else {
				echo "<script type='text/javascript'>alert('Login Failed');</script>";
			}	

		}

		else {
			run_login();

		}

	}

	function validate($username, $password) {
		$file = fopen("passwd.txt", "r");
		$verified = False;
	
		while (!feof($file)) {
			$line = fgets($file);
			$line_array = explode( ':', $line);
			$user = trim($line_array[0]);
			$pass = trim($line_array[1]);
			
			if ($user == $username && $pass == $password) {
				$verified = True;
			}
		}

		fclose ($file);
		return $verified;
	}

	function run_login() {
		print<<<LOGIN
		<html>

		<head>
   		<title>Login</title>
   		<meta charset="UTF-8">
   		<meta name="description" content="Login">
   		<meta name="author" content="Mariana Herreria">
   		<link href="actions.css" rel="stylesheet">
		</head> 

		<body>
		<br>

		<div id = "login-wrapper">
		<h2> Log in to access database </h2>
		<form method = "post" action = "index.php">
		<p><b>Username:</b>
		<input name = "user" type = "text" size = "38" placeholder="Enter Username" required/>
		</p>
		<p>
		<b>Password:</b>
		<input name = "pass" type = "password" size = "38" placeholder="Enter Password" required/>
		</p>
		<button name="login" type="submit">Login</button>
		<button type="reset">Reset</button>
		</form>
		</div>

	</body>
	</html>

LOGIN;

	}

?>