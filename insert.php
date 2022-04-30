<style><?php include 'actions.css'; ?></style>

<?php

	if (isset($_POST["submit"])) {
		$id = $_POST["id"];
		$lastName = $_POST["lastName"];
		$firstName = $_POST["firstName"];
		$major = $_POST["major"];
		$gpa = $_POST["gpa"];
	
		run_page();
		
		sql($id, $lastName, $firstName, $major, $gpa);

	} else {

		run_page();

	}


	function sql($id, $lastName, $firstName, $major, $gpa) {

		$server = "spring-2022.cs.utexas.edu";
		$user = "cs329e_bulko_mariana";
		$password = "derby6crude6divine";
		$dbName = "cs329e_bulko_mariana";
		$mysqli = new mysqli ($server, $user, $password, $dbName);
		
		if ($mysqli -> connect_errno) {
			die('Connect Error: ' . $mysqli -> connect_errno . ': ' . $mysqli -> connect_errno);
		}

		$command = "INSERT INTO students VALUES ('$id', '$lastName', '$firstName', '$major', '$gpa')";
		$mysqli -> query($command);

		echo "<p align='center'> <font color='#592300'> Database updated </font></p>";
		
	}


	function run_page() {
		print<<<INSERT
		<html>

		<head>
   		<title>Insert Student Record</title>
   		<meta charset="UTF-8">
   		<meta name="description" content="insert student records">
   		<meta name="author" content="Mariana Herreria">
   		<link href="actions.css" rel="stylesheet">
		</head> 

		<body>
		<br>

		<div id = "login-wrapper">
		<h2> Insert Student Record </h2>
		<form method = "post" action = "insert.php">
		<table >
		<tr>
		<td><b>Student id:</b></td>
		<td><input name = "id" type = "text" size = "40" placeholder="Enter Student id" required/></td>
		</tr>

		<tr>
		<td><b>Last Name:</b></td>
		<td><input name = "lastName" type = "text" size = "40" placeholder="Enter Last Name" required/></td>
		</tr>

		<tr>
		<td><b>First Name:</b></td>
		<td><input name = "firstName" type = "text" size = "40" placeholder="Enter First Name" required/></td>
		</tr>

		<tr>
		<td><b>Major:</b></td>
		<td><input name = "major" type = "text" size = "40" placeholder="Enter Major" required/></td>
		</tr>
		
		<tr>
		<td><b>GPA:</b></td>
		<td><input name = "gpa" type = "text" size = "40" placeholder="Enter GPA" required/></td>
		</tr>
		</table>
		<br>

		<button> Submit </button>
		<button> Reset </button>
		</form>
		</div>
		</body>
		</html>

INSERT;

	}
	
?>