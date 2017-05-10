<?php session_start();
//echo($_POST['name']);
//echo "<br>";
//echo($_POST['email']);
//echo "<br>";
//echo($_POST['user']);
//echo "<br>";
//echo($_POST['pw']);
//echo "<br>";
//print_r($_FILES['photo']);
//echo "<br>";
//echo($_FILES['photo']['name']);
//echo "<br>";
//echo($_FILES['photo']['type']);

$fn = $_POST['fname'];
$ln = $_POST['lname'];
$e = $_POST['email'];
$u = $_POST['user'];
$p = $_POST['pw'];



$t = "$fn\n$ln\n$e\n$u\n$p\n";
//echo $t;
mkdir ($u);
$f= fopen("$u/profile.txt", "w") or die();
fwrite($f,$t) or die();
fclose($f);

if( $_FILES ){
	$a = $_FILES['photo']['type'];
	switch( $a ){
		case 'image/jpeg':
			$ext = 'jpg';
			break;
		case 'image/png':
			$ext = 'png';
			break;
		default:
			$ext = '';
			break;
	}
	if ( $ext ){
		$it = $_FILES['photo']['tmp_name'];
		$d = "$u/image.$ext";
		move_uploaded_file($it , $d);
	}
};

$b = "info@artbyeloi.com";
$s = "New user: $n";
$h = 'From: '.$b."\r\n".'Reply-To: '.$b."\r\n".'X-Mailer: PHP/'.phpversion();

mail($b, $s, $t, $h);


$_SESSION ['user'] = $u;
$_SESSION ['img'] = $d;

//sql connect
$cnt = mysqli_connect("localhost", "root", "root", "janderson");
//sql query
$qry = "INSERT INTO captur (name, email, pwd) VALUES ('$n','$e','$p');";

mysqli_query($cnt, $qry);
//sql close
mysqli_close($cnt);

header('Location: confirmed.php');


?>