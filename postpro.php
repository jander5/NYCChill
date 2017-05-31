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
$p = $_POST['pw'];

$fl = $fn . $ln;
//echo $fl;

$t = "$fl\n$e\n$p\n";
//echo $t;
mkdir ($fl);
$f= fopen("$fl/profile.txt", "w") or die();
fwrite($f,$t) or die();
fclose($f);


$b = "jessica.anderson90@gmail.com";
$s = "New user: $fl";
$h = 'From: '.$b."\r\n".'Reply-To: '.$b."\r\n".'X-Mailer: PHP/'.phpversion();

mail($b, $s, $t, $h);


$_SESSION ['fname'] = $fn;
$_SESSION ['lname'] = $ln;


//sql connect
$cnt = mysqli_connect("localhost", "root", "root", "janderson");
//sql query
$qry = "INSERT INTO nycchill (name, email, pwd) VALUES ('$fl','$e','$p');";

mysqli_query($cnt, $qry);
//sql close
mysqli_close($cnt);

header('Location: up.html');


?>