<?php

//==================================================
// Check to see if request was an HTTP POST
//==================================================
if(!isset($_POST['submit'])) { // check to see if there was a 'submit' variable set
	// send response back to browser that there was an error
    $data = [ 'success' => 'false', 'message' => 'Accessing this service directly is not allowed.' ];
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($data);
	exit;
}

//==================================================
// Check all required variables are set
//==================================================
if(empty($_POST['email']) || empty($_POST['name']) || empty($_POST['comment'])) {
	// send response back to browser that there was an error
    $data = [ 'success' => 'false', 'message' => 'Email, name, and comment required.' ];
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($data);
    exit;
}

//==================================================
// Assign POST variables to local variables
//==================================================
$email = preg_replace("([\r\n])", "", $_POST['email']); // Remove 'return' or 'new line' with ''
$name = $_POST['name'];
$comment = $_POST['comment'];

//==================================================
// Assign POST variables to local variables
//==================================================
$find = "/(content-type|bcc:|cc:)/i";
if(preg_match($find, $name) || preg_match($find, $email) || preg_match($find, $comment)) {
	// send response back to browser that there was an error
    $data = [ 'success' => 'false', 'message' => 'No meta/header injections, please.' ];
    header('Content-type:application/json;charset=utf-8');
    echo json_encode($data);
    exit;
}

//==================================================
// Send email
//==================================================
$to = "mlmasters@gmail.com";
$subject = "CONTACT FORM";

// compose headers
$headers = "From: webmaster@dev.digitaldarwin.com\r\n";
$headers .= "Reply-To: ".$email."\r\n";
$headers .= "X-Mailer: PHP/".phpversion();


// send email
mail($to, $subject, $comment, $headers);


// send response back to browser
$data = [ 'success' => 'true', 'message' => 'Email sent.' ];
header('Content-type:application/json;charset=utf-8');
echo json_encode($data);
exit;
?>