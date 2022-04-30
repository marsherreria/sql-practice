<style><?php include 'actions.css'; ?></style>

<?php

	if (isset($_POST["submit"])) {
		$id = $_POST["id"];
		$lastName = $_POST["lastName"];
		$firstName = $_POST["firstName"];
		$major = $_POST["major"];
		$gpa = $_POST["gpa"];
	
		run_page();
		

		$validated = validate($lastName, $firstName, $major, $gpa);

		if ($validated != True) {
			echo "<script type='text/javascript'>alert('You must fill out one more field');</script>";
		}

		else {

			sql($id, $lastName, $firstName, $major, $gpa);

		}

	} else {

		run_page();

	}


	function validate($lastName, $firstName, $major, $gpa) {

		$validated = False;
		if ($id != '' || $lastName != '' || $firstName != '' || $major != '' || $gpa != '') {
			$validated = True;
		}
		
		return $validated;
	}


	function sql($id, $lastName, $firstName, $major, $gpa) {

		$server = "spring-2022.cs.utexas.edu";
		$user = "cs329e_bulko_mariana";
		$password = "derby6crude6divine";
		$dbName = "cs329e_bulko_mariana";
		$mysqli = new mysqli ($server, $user, $password, $dbName);

		if ($lastName == '') {

			$command = "SELECT lastName FROM students WHERE id = \"$id\"";
			$result = $mysqli -> query($command);
			$row = $result->fetch_row();
			$lastName = $row[0];

		}

		if ($firstName == '') {

			$command = "SELECT firstName FROM students WHERE id = \"$id\"";
			$result = $mysqli -> query($command);
			$row = $result->fetch_row();
			$firstName = $row[0];

		}

		if ($major == '') {
			$command = "SELECT major FROM students WHERE id = \"$id\"";
			$result = $mysqli -> query($command);
			$row = $result->fetch_row();
			$major = $row[0];
		}

		if ($gpa == '') {
			$command = "SELECT gpa FROM students WHERE id = \"$id\"";
			$result = $mysqli -> query($command);
			$row = $result->fetch_row();
			$gpa = $row[0];
		}


		$command = "UPDATE students SET lastName = '$lastName', firstName = '$firstName', major = '$major', gpa = '$gpa' WHERE id = '$id'";

		$mysqli -> query($command);

		echo "<p align='center'> <font color='#592300'> Database updated </font></p>";

	}

	function run_page() {

		print<<<UPDATE

		<html>

		<head>
   		<title>Update Student Record</title>
   		<meta charset="UTF-8">
   		<meta name="description" content="update student records">
   		<meta name="author" content="Mariana Herreria">
   		<link href="actions.css" rel="stylesheet">
		</head> 

		<body>
		<br>

		<div id = "login-wrapper">
		<h2> Update Student Record </h2>
		<form method = "post" action = "update.php">
		<table>
		<tr>
		<td><b>Student id:</b></td>
		<td><input name = "id" type = "text" size = "40" placeholder="Enter Student id" required/></td>
		</tr>

		<tr>
		<td><b> Last Name: </b></td>
		<td><input name = "lastName" type = "text" size = "40" placeholder="Enter Last Name"/></td>
		</tr>

		<tr>
		<td><b> First Name: </b></td>
		<td><input name = "firstName" type = "text" size = "40" placeholder="Enter First Name"/></td>
		</tr>

		<tr>
		<td><b> Major: </b></td>
		<td><input name = "major" type = "text" size = "40" placeholder="Enter Major"/></td>
		</tr>
		
		<tr>
		<td><b>GPA:</b></td>
		<td><input name = "gpa" type = "text" size = "40" placeholder="Enter GPA"/></td>
		</tr>
		</table>
		<br>

		<button> Submit </button>
		<button> Reset </button>
		</form>
		</div>
		</body>
		</html>

UPDATE;

	}
	
?>