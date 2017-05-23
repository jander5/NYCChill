<?php
		
if(isset($_POST['submit'])){
	if (empty($_POST['email']) || empty($_POST['pw'])) {
	echo "Username or Password is invalid";
} else {
	$email=$_POST['email'];
	$pw=$_POST['pw'];

	$connection = mysqli_connect("localhost", "root", "root", "phptest");

	$query = "select * from capture where pw='$pw' AND email='$email'";

	$loginCheck = mysqli_query($connection, $query);

	$rows = mysqli_num_rows($loginCheck);

	echo $rows;

	echo "<br>";

	if ($rows == 1) {
		while($row = mysqli_fetch_assoc($loginCheck)) {
			//echo $row["uid"].'<br>';
			$_SESSION['uid'] = $row["uid"];
			//echo $row["time"].'<br>';
			$_SESSION['time'] = $row["time"];
			//echo $row["name"].'<br>';
			$_SESSION['name'] = $row["name"];
			//echo $row["email"].'<br>';
			$_SESSION['email'] = $row["email"];
			//echo $row["pw"].'<br>';
			$_SESSION['pw'] = $row["pw"];
			echo "<a href=\"up.html\">proceed to profile</a>";
		}
	} 
	else {
		echo "try again";
	}
	mysqli_close($connection); // Closing Connection
}
}
?>