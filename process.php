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



$u = $g."_".$n;
mkdir($u);

$thumb = array();
// Store the image on my service
if (file_exists($_FILES['file1']['tmp_name'])){
//print_r($_FILES['file1']);
$t = $_FILES['file1']['tmp_name'];
$f = "$u/img1.jpg";
move_uploaded_file( $t, $f); 
array_push($thumb, $f);
}

if (file_exists($_FILES['file2']['tmp_name'])){
//print_r($_FILES['file2']);
$t2 = $_FILES['file2']['tmp_name'];
$f2 = "$u/img2.jpg";
move_uploaded_file( $t2, $f2);
array_push($thumb, $f2);
}

if (file_exists($_FILES['file3']['tmp_name'])){
//print_r($_FILES['file3']);
$t3 = $_FILES['file3']['tmp_name'];
$f3 = "$u/img3.jpg";
move_uploaded_file( $t3, $f3);
array_push($thumb, $f3);
}

if (file_exists($_FILES['file4']['tmp_name'])){
//print_r($_FILES['file4']);
$t4 = $_FILES['file4']['tmp_name'];
$f4 = "$u/img4.jpg";
move_uploaded_file( $t4, $f4); 
array_push($thumb, $f4);
}

$add = array(

	"location" => $n,
	"year" => $g,
	"thumbs" => $thumb
);

// append my new array into the json array
$j[$k] = $add;

// take my updated json array, format it back into Json and Overwrite it into the Json file
$ju = json_encode($j);
file_put_contents('obj.json', $ju);


header('location:site.html');
?> 