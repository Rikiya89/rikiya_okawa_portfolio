<?php
// Final Production Contact Handler with SPF Authentication
// This is the clean, production-ready version for your portfolio

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get and sanitize form data
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
        $to = "rikiyadazo89@gmail.com";
        $subject = "Portfolio Contact: Message from " . $name;
        
        // Create email content
        $email_content = "New contact form submission from your portfolio:\n\n";
        $email_content .= "Name: " . $name . "\n";
        $email_content .= "Email: " . $email . "\n";
        $email_content .= "Submitted: " . date('Y-m-d H:i:s') . "\n";
        $email_content .= "From: " . $_SERVER['HTTP_HOST'] . "\n\n";
        $email_content .= "Message:\n" . $message . "\n\n";
        $email_content .= "---\nSent from your portfolio contact form\n";
        $email_content .= "You can reply directly to this email to respond to " . $name;
        
        // Optimized headers for SPF authentication
        $domain = $_SERVER['HTTP_HOST'];
        $headers = array();
        $headers[] = "From: Portfolio Contact <contact@" . $domain . ">";
        $headers[] = "Reply-To: " . $name . " <" . $email . ">";
        $headers[] = "Return-Path: contact@" . $domain;
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/plain; charset=UTF-8";
        $headers[] = "X-Mailer: PHP/" . phpversion();
        $headers[] = "Message-ID: <" . time() . "." . uniqid() . "@" . $domain . ">";
        
        // Send email
        $mail_sent = mail($to, $subject, $email_content, implode("\r\n", $headers));
        
        if ($mail_sent) {
            $success_message = "Thank you for your message! I'll get back to you soon.";
            
            // Log successful submission (optional)
            $log_entry = date('Y-m-d H:i:s') . " - Contact from: $name ($email)\n";
            @file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
            
        } else {
            $error_message = "Sorry, there was an issue sending your message. Please try again or contact me directly at rikiyadazo89@gmail.com";
        }
        
    } else {
        $error_message = "Please fix the following: " . implode(", ", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form - Rikiya Okawa Portfolio</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #f8f9fa;
            line-height: 1.6;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .message {
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: 500;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .back-link {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .back-link:hover {
            background: #0056b3;
        }
        .contact-info {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
        }
        .contact-info h3 {
            margin-top: 0;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Form Response</h1>
        
        <?php if (isset($success_message)): ?>
            <div class="message success">
                ✅ <?php echo htmlspecialchars($success_message); ?>
            </div>
            
            <div class="contact-info">
                <h3>Thank you for reaching out!</h3>
                <p>I've received your message and will respond as soon as possible.</p>
                <p>You can also connect with me on:</p>
                <p>
                    <a href="https://www.linkedin.com/in/rikiya-okawa369/" target="_blank">LinkedIn</a> |
                    <a href="https://www.instagram.com/ricky_o_369/" target="_blank">Instagram</a> |
                    <a href="https://twitter.com/ricky_o_0430" target="_blank">Twitter</a>
                </p>
            </div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="message error">
                ❌ <?php echo htmlspecialchars($error_message); ?>
            </div>
            
            <div class="contact-info">
                <h3>Alternative Contact Methods</h3>
                <p>If you continue to have issues, please reach out directly:</p>
                <p><strong>Email:</strong> rikiyadazo89@gmail.com</p>
                <p><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/rikiya-okawa369/" target="_blank">Rikiya Okawa</a></p>
            </div>
        <?php endif; ?>
        
        <a href="index.html" class="back-link">← Back to Portfolio</a>
    </div>
</body>
</html>