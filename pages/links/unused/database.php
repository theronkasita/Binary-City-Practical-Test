<?php
// $_SESSION['success'] = "";
// $_SESSION['error'] = "";

class Data
{
	// connMS connection code -> hostname, username, password, database name
	private $hostname = 'localhost';
	private $username = 'root';
	private $password = '';
	private $database = 'binarycity_db';


	// Registration code
	function connect()
	{
		return mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
	}

	// User login
	function login($query)
	{
		$conn = $this->connect();

		$results = mysqli_query($conn, $query);

		// $results = 1 means that one user with the
		// entered username exists
		if (mysqli_num_rows($results) == 1) {
			// Welcome message
			$_SESSION['success'] = "You have logged in!";
			// Page on which the user is sent
			// to after logging in
			echo "<script>alert('Correct');</script>";
			return true;
		} else {
			// If the username and password doesn't match
			echo "<script>alert('Incorect');</script>";
			return false;
		}


		// Close connection
		$conn->close();
	}

	// insert data into database
	function logg($data, $id)
	{
		$sql = "INSERT INTO `tbllogs`(`USERID`, `LOGROLE`, `LOGMODE`) VALUES ('" . $_SESSION['ACCOUNT_ID'] . "','" . $_SESSION['ACCOUNT_TYPE'] . "',' " . $data . "  " . $id . " ')";
		$conn =  $this->connect();
		if ($conn == false) {
			die("ERROR: Could not connect. " . $this->conn->connect_error);
		}
		if ($conn->query($sql) == true) {
			// Close connection
			$conn->close();
			return true;
		} else {
			$msg =  "ERROR: Could not able to execute $sql. " . $conn->error;
			$this->alert(1, $msg);
			// Close connection
			$conn->close();
			return false;
		}
	}

	// insert data into database
	function insertData($sql)
	{
		$conn =  $this->connect();

		if ($conn == false) {
			die("ERROR: Could not connect. " . $this->conn->connect_error);
		}


		if ($conn->query($sql) == true) {
			// Close connection
			$conn->close();

			return true;
		} else {
			$msg =  "ERROR: Could not able to execute $sql. " . $conn->error;
			$this->alert(1, $msg);
			// Close connection
			$conn->close();

			return false;
		}
	}

	// get data
	function getData($sql)
	{
		// connect the database with the server
		$conn =  $this->connect();

		// if error occurs 
		if ($conn->connect_errno) {
			echo "Failed to connect to MySQL: " . $conn->connect_error;
			exit();
		}
		$result = ($conn->query($sql));
		//declare array to store the data of database
		$row = [];

		if ($result->num_rows > 0) {
			// fetch all data from conn into array 
			$row = $result->fetch_all(MYSQLI_ASSOC);
		}

		// Close connection
		$conn->close();

		return $row;
	}

	// get Rows
	function getRows($sql)
	{

		$conn =  $this->connect();

		if ($result = mysqli_query($conn, $sql)) {

			// Return the number of rows in result set
			$rowcount = mysqli_num_rows($result);
		}

		// Close connection
		$conn->close();

		return $rowcount;
	}

	// get data
	function getSingleData($sql)
	{
		// Create connection
		$conn =  $this->connect();

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			if ($row = $result->fetch_assoc()) {
				return $row;
			}
		} else {
			return 0;
		}
		$conn->close();
	}

	function reload()
	{
		echo '<script>';
		echo '
		
		const reloadUsingLocationHash = () => {
			window.location.hash = "reload";
		  }
		  window.onload = reloadUsingLocationHash();
		';
		echo '</script>';
	}

	function alert($alert, $msg)
	{
		if ($alert) :
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
			echo '  <strong>Success! </strong>' . $msg . '.';
			echo '	  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
			echo '	</div>';
		else :
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
			echo '  <strong>Error! </strong>' . $msg . '.';
			echo '	  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
			echo '	</div>';
		endif;
	}
}

$mydb = new data();
