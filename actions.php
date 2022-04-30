<style><?php include 'actions.css'; ?></style>

<?php

	session_start();

	if (isset($_SESSION["username"]) && !isset($_POST["logout"])) {
		run_page();
	}
	
	else {
		logout();
	}

	function logout() {

		echo "<script type='text/javascript'>alert('Thank you');</script>";
		echo "You have been logged out.";
		session_destroy();

	}


	function run_page() {
	print<<<ACTIONS
		<html>

		<head>
   		<title>Actions</title>
   		<meta charset="UTF-8">
   		<meta name="description" content="Actions">
   		<meta name="author" content="Mariana Herreria">
   		<link href="actions.css" rel="stylesheet">
		</head> 


	<body>
	<br>
	<div class = "box">
	<p> <a href = "insert.php">Insert Student Record</a> </p>
	</div>
	<br>


	<div class = "box">
	<p> <a href = "update.php">Update Student Record</a> </p>
	</div>
	<br>


	<div class = "box">
	<p> <a href = "delete.php">Delete Student Record</a> </p>
	</div>
	<br>


	<div class = "box">
	<p> <a href = "view.php">View Student Record</a> </p>
	</div>
	<br>
	

	<form action="actions.php", method="post">
	<button id="button" name="logout" type="submit">Logout</button>
	</form>


	</body>
	</html>	
ACTIONS;

}

?>