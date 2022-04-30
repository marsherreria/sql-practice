<style><?php include 'actions.css'; ?></style>

<?php

	if (isset($_POST["submit"])) {

		$id = $_POST["id"];
		$lastName = $_POST["lastName"];
		$firstName = $_POST["firstName"];
		run_page();

		$validated = validate($id, $lastName, $firstName);

		if ($validated != True) {

			echo "<script type='text/javascript'>alert('You must fill out at least one field');</script>";

		}

		else {

			sql($id, $lastName, $firstName);	

		}

	} elseif (isset($_POST["view"])) {

		run_page();
		view_all();

	}

	else {

		run_page();

	}


	function validate($id, $lastName, $firstName) {

		$validated = False;
		if ($id != '' || $lastName != '' || $firstName != '') {

			$validated = True;

		}
		
		return $validated;

	}


	function sql($id, $lastName, $firstName) {

		$server = "spring-2022.cs.utexas.edu";
		$user = "cs329e_bulko_mariana";
		$password = "derby6crude6divine";
		$dbName = "cs329e_bulko_mariana";
		$mysqli = new mysqli ($server, $user, $password, $dbName);
		
		if ($mysqli -> connect_errno) {

			die('Connect Error: ' . $mysqli -> connect_errno . ': ' . $mysqli -> connect_errno);

		}

		if ($lastName == '' && $firstName == '') {
			$command = "SELECT * FROM students WHERE id = \"$id\"";

		} elseif ($id == '' && $firstName == '') {
			$command = "SELECT * FROM students WHERE lastName = \"$lastName\"";	

		} elseif ($id == '' && $lastName == '') {
			$command = "SELECT * FROM students WHERE firstName = \"$firstName\"";

		} elseif ($lastName == '') {
			$command = "SELECT * FROM students WHERE id = \"$id\" AND firstName = \"$firstName\"";

		} elseif ($firstName == '') {
			$command = "SELECT * FROM students WHERE id = \"$id\" AND lastName = \"$lastName\"";

		} elseif ($id == '') {
			$command = "SELECT * FROM students WHERE lastName = \"$lastName\" AND firstName = \"$firstName\"";

		} else {
			$command = "SELECT * FROM students WHERE lastName = \"$lastName\" AND firstName = \"$firstName\" AND id = \"$id\"";
		}


		$result = $mysqli -> query($command);

		if ($result->num_rows > 0) {

			print<<<TABLE
			<br>
			<h2> Results </h2>
			<table id = "results">
			<tr>
			<th>ID</th>
			<th>Last Name</th>
			<th>First Name</th>
			<th>Major</th>
			<th>GPA</th>
			</tr>
TABLE;
		
        		while($row = $result->fetch_assoc()) {
				$id = $row["id"];
				$lastName = $row["lastName"];
				$firstName = $row["firstName"];
				$major = $row["major"];
				$gpa = $row["gpa"];

				print<<<TABLEI
				<tr>
				<td>$id</td>
				<td>$lastName</td>
				<td>$firstName</td>
				<td>$major</td>
				<td>$gpa</td>
				</tr>
TABLEI;
			}

		}


		else {
			echo "<p align='center'> <font color='#592300'> No matches </font></p>";

		}
			
	}

	function view_all() {

		$server = "spring-2022.cs.utexas.edu";
		$user = "cs329e_bulko_mariana";
		$password = "derby6crude6divine";
		$dbName = "cs329e_bulko_mariana";
		$mysqli = new mysqli ($server, $user, $password, $dbName);
		$command = "SELECT * FROM students";
		$result = $mysqli -> query($command);

		if ($result->num_rows > 0) {

			print<<<TABLE1
			<br>
			<h2> Results </h2>
			<table id = "results">
			<tr>
			<th>id</th>
			<th>Last Name</th>
			<th>First Name</th>
			<th>Major</th>
			<th>GPA</th>
			</tr>
TABLE1;
        		while($row = $result->fetch_assoc()) {
				$id = $row["id"];
				$lastName = $row["lastName"];
				$first = $row["firstName"];
				$major = $row["major"];
				$gpa = $row["gpa"];

				print<<<TABLE2
				<tr>
				<td>$id</td>
				<td>$lastName</td>
				<td>$firstName</td>
				<td>$major</td>
				<td>$gpa</td>
				</tr>
TABLE2;
        		}
			print<<<TABLE3
			</table>
TABLE3;
    		}
		else {
			echo "There are no rows in this dataset.";

		}
	}

	function run_page() {
		print<<<VIEW
		<html>

		<head>
   		<title>View Student Record</title>
   		<meta charset="UTF-8">
   		<meta name="description" content="view student records">
   		<meta name="author" content="Mariana Herreria">
   		<link href="actions.css" rel="stylesheet">
		</head> 

		<body>
		<br>

		<div id = "login-wrapper">
		<h2> View Student Record </h2>
		<form method = "post" action = "view.php">
		<table>
		<tr>
		<td><b> Student ID: </b></td>
		<td><input name = "id" type = "text" size = "40" placeholder="Enter Student ID" /></td>
		</tr>

		<tr>
		<td><b>Last Name:</b></td>
		<td><input name = "lastName" type = "text" size = "40" placeholder="Enter Last Name" /></td>
		</tr>

		<tr>
		<td><b>First Name:</b></td>
		<td><input name = "firstName" type = "text" size = "40" placeholder="Enter First Name" /></td>
		</tr>

		</table>
		<br>

		<button name="submit" type="submit">Submit</button>
		<button type="reset">Reset</button>
		<button name="view" type="submit">View All Student Records</button>
		
		</form>
		</div>
		</body>
		</html>
VIEW;

	}
	
?>