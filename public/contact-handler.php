<?php
// Basic PHP Contact Form Handler
// This script receives form data and sends an email

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data and clean it
    $name = filter_input(INPUT_POST, 'sender-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'sender-email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // Validate required fields
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        
        // Email configuration
        $to = "rikiyadazo89@gmail.com"; // Your email address
        $subject = "Contact Form Message from " . $name;
        
        // Create email content
        $email_content = "Name: " . $name . "\n";
        $email_content .= "Email: " . $email . "\n\n";
        $email_content .= "Message:\n" . $message;
        
        // Email headers
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Send email
        if (mail($to, $subject, $email_content, $headers)) {
            $success_message = "Thank you! Your message has been sent.";
        } else {
            $error_message = "Sorry, there was an error sending your message. Please try again.";
        }
        
    } else {
        $error_message = "Please fix the following errors: " . implode(", ", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Response</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .message {
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Contact Form</h1>
    
    <?php if (isset($success_message)): ?>
        <div class="message success">
            <?php echo htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($error_message)): ?>
        <div class="message error">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>
    
    <a href="index.html" class="back-link">← Back to Portfolio</a>
</body>
</html>