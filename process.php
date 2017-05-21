<?php
//Store data from my form into variables
$n = $_POST['location'];
$g = $_POST['year'];

//retrieve the Jason file and converted it into php array
$jr = file_get_contents('obj.json');
$j = json_decode($jr, true);


// find the last object within my array to create the key for the object I'm about to insert
if (count($j) == 0){
	$objectCount = 1;
} else {
	$objectCount = count($j) + 1;
}

$k = "object".$objectCount;


// insert my variables into an array stored in a variable called $add
$add = array(

	"location" => $n,
	"year" => $g
);


// append my new array into the json array
$j[$k] = $add;

// take my updated json array, format it back into Json and Overwrite it into the Json file
$ju = json_encode($j);
file_put_contents('obj.json', $ju);

$u = $g."_".$n;
mkdir($u);


// Store the image on my service
$t = $_FILES['file1']['tmp_name'];
$f = "$u/img1.jpg";
move_uploaded_file( $t, $f); 



$t2 = $_FILES['file2']['tmp_name'];
$f2 = "$u/img2.jpg";
move_uploaded_file( $t2, $f2); 



$t3 = $_FILES['file3']['tmp_name'];
$f3 = "$u/img3.jpg";
move_uploaded_file( $t3, $f3); 



$t4 = $_FILES['file4']['tmp_name'];
$f4 = "$u/img4.jpg";
move_uploaded_file( $t4, $f4); 


header('location:site.html');
?> 