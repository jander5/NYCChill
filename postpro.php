<?php session_start();
// start a session to carry variables between pages

//start an is statement using the ISSET method to validate that there is a value in the "email field"
// $_POST is a Super Global in PHP that carried the entered data from specific form fields.
//In this case it's the form field with the NAME of EMAIL.
if(isset($_POST['email'])) {
	//take the NAME and EMAIL data and store them into variables $name and $email
	$fname = $_POST['fname'];
    $lname = $_POST['lname'];
//	$email = $_POST['email'];

	//Similarly take data from the USER field and assign to 2 variables: $user will be used for the rest of this script
	// $_SESSION is a super global that can be called and edited from Page to page since we started with a session on line 3
	$email = $_SESSION['email'] = $_POST['email'];
	$pw = $_POST['pw'];

/*Start the email proccessing*/
	//Now that we have the form data stored, We can do things with it. Like sending an email.
	//To do so, create a variable that contains the email body using a combo of srtings and variables
	$email_message = "Name: $fname \n Email: $email";

	//store the subject in a variable
	$email_subject = "Message from $fname"; 

	//store the email recipient in a variable
	$email_to = "info@artbyeloi.com";

	//create email headers, the hidden code on top of all emails, read by the mail client.
	//regardless this configuration, the only thing that you would change on this line is if the $emails variable is the email address you want in the REPLY and FROM lines.
	$headers = 'From: '.$email."\r\n".'Reply-To: '.$email."\r\n".'X-Mailer: PHP/'.phpversion();

	//build your email using the @Mail method, using the parameters of the variables that you just created in this order...
	// email recipient, email subject, email message, email headers
	mail($email_to, $email_subject, $email_message, $headers);

/*End email proccessing*/
/*Start the file Proccessing*/

	//Now that we have sent out an email let's also take Data from the form and store it.
	//We will create a folder with The name of the user. And within this folder will be an image the user uploaded and a text file  containing the text input Data values
	// since the text document and the image will have the same file names regardless of the user
	//we will uniquely name each directory by the username
    $users = $fname+'.'+lname;
	mkdir($users);

	// is the Fopen method to Create a text file with the name profile.txt, stored in the directory we just created.
	// the second parameter "W" Gives us permission write in this file
	$fh = fopen("$users/profile.txt", 'w') or die();

	//Create a variable that contains the strings of all the data we want to store in the text document
	$text = "$fname \n $lname \n $email  \n $pw";

	// use the fwrite method to call the file we created and insert the text please stories in the Previous
	fwrite( $fh, $text) or die("Could not write to file"); 

	// use the Fclose method to close the text document after we've written to it
	fclose( $fh); 

	// run another if statement to validate if a photo was uploaded by the user. If true do the following…
/*	if ( $_FILES ) { 
		// Store the file name and a variable $Image
		$image = $_FILES['photo']['name'];
		
		// call the file type and check it against the following cases
		switch( $_FILES['photo']['type'] ) { 
			// check if it's a JPEG. if so assign $EXT the value of JPG
			case 'image/jpeg': 
				$ext = 'jpg'; 
				break;
			// check if it's a PNG. If so assign $EXT the value of PNG
			case 'image/png': 
				$ext = 'png'; 
				break;
			// is neither of the two checks are true, assign $EXT value null
			default: 
				$ext = ''; 
				break;
	}
	// run another if statement checking if $EXT has a value other than null
	// as seen above this would mean $EXT would be either a PNG or a JPG
	if ($ext) {

		// create variable with the desired files path and name
		$n = "$user/image.$ext"; 

		// the file to the server  and assign it the Path and name we specified previously
		move_uploaded_file( $_FILES['photo']['tmp_name'], $n);
		
		//finally store as a session variable to call later
		$_SESSION['img'] = $n;
	}
	} else {
		echo "No image has been uploaded";
	}; **/

/*Start Store to SQL DB*/
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysqli_connect("localhost", "root", "root", "phptest");

		$query = "INSERT INTO capture (uid, time, name, email, pw) VALUES (NULL, NULL, '$users', '$email','$pw');";

		mysqli_query($connection, $query);

		if (!$connection) {
			echo "Error: " . $query . "<br>" . $connection->error;
		}

		mysqli_close($connection); // Closing Connection
/*End Store to SQL DB*/

//Finally once all the data is processed proceeded to user to the confirmation Page
	header('Location: confirmed.php');
}
?>