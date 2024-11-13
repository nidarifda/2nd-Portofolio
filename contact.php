<?php
// Check if the form data is valid
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Bad request response code
    exit();
}

// Sanitize form inputs
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitize email address
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Prepare email details
$to = "info@example.com"; // Change this email to your target email address
$subject = "$subject: $name";
$body = "You have received a new message from your website contact form.\n\nHere are the details:\n\nName: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

// Set headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // Set proper content type for plain text

// Send the email
if (!mail($to, $subject, $body, $headers)) {
    http_response_code(500); // Internal Server Error response code
    exit();
}
?>
