<?php
// Check if form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Collect form data
  $user_name = htmlspecialchars(trim($_POST['name']));
  $user_email = htmlspecialchars(trim($_POST['email']));
  $user_message = htmlspecialchars(trim($_POST['message']));

  // Validate email
  if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
    echo "<p style='color: red;'>Invalid email format.</p>";
    exit;
  }

  // Prepare email details
  $email_from = $user_email;
  $email_subject = "New Contact Form Submission";
  $email_body = "Name: $user_name\n" .
    "Email: $user_email\n" .
    "Message:\n$user_message\n";

  // Recipient email address
  $to_email = "info@vahiny.in"; // Change this to your email address

  // Set email headers
  $headers = "From: $email_from" . "\r\n" .
    "Reply-To: $user_email" . "\r\n" .
    "Content-Type: text/plain; charset=UTF-8"; // Set the content type as plain text

  // Send the email
  if (mail($to_email, $email_subject, $email_body, $headers)) {
    // Email sent successfully, display success message
    echo "<p>Thank you, $user_name! Your message has been sent successfully. We'll get back to you soon.</p>";
  } else {
    // If there was an error sending the email
    echo "<p style='color: red;'>Oops! Something went wrong, and we couldn't send your message. Please try again later.</p>";
  }
} else {
  echo "<p style='color: red;'>Invalid request method.</p>";
}
?>