<?php

// check to see if this is a POST request. Error out if it isn't
if (!isset($_POST['submit'])) {
    echo "<h1>Error</h1>\n
        <p>Accessing this page directly is not allowed.</p>";
    exit;
}

// replace carriage returns and new lines with "" in the email
$email = preg_replace("([\r\n])", "", $_POST["email"]);

// Prevent email header injection
$find = "/(content-type|bcc:|cc:)/i";
if (preg_match($find, $_POST["name"])
    || preg_match($find, $_POST["email"])
    || preg_match($find, $_POST["findus"])
    || preg_match($find, $_POST["message"])) {

    // if someone tried to manually set email headers, then
    // tell them to beat it
    echo "<h1>Error</h1>\n
        <p>No meta/header injections, please.</p>";

    exit;
}

// now send email

$to = "mlmasters+matthewmasters.com@gmail.com";
$subject = "MatthewMasters.com CONTACT FORM";

$content = "
<html>
<head>
</head>
    <body>
        <p>find us: ".$_POST["findus"]."</p>
        <p>email: ".$_POST["email"]."</p>
        <p>message: ".$_POST["message"]."</p>
    </body>
</html>";

// To send HTML mail, the Content-type header must be set
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

// send email
mail($to, $subject, $content, $headers);

header('Location: http://www.matthewmasters.com');

?>
