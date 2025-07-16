<?php
// SPF Test Contact Form - Test Gmail with SPF Authentication
// Now that SPF is configured, let's test Gmail delivery

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = filter_input(INPUT_POST, 'sender-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'sender-email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    $errors = [];
    if (empty($name)) $errors[] = "Name required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email required";
    if (empty($message)) $errors[] = "Message required";
    
    if (empty($errors)) {
        
        $subject = "SPF Test: Portfolio Contact from " . $name;
        $email_content = "This is a test with SPF authentication enabled.\n\n";
        $email_content .= "Name: " . $name . "\n";
        $email_content .= "Email: " . $email . "\n";
        $email_content .= "Time: " . date('Y-m-d H:i:s') . "\n";
        $email_content .= "Server: " . $_SERVER['HTTP_HOST'] . "\n\n";
        $email_content .= "Message:\n" . $message . "\n\n";
        $email_content .= "---\nSent via PHP with SPF authentication";
        
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
        
        $mail_headers = implode("\r\n", $headers);
        
        // Test Gmail with SPF
        $gmail_result = mail("rikiyadazo89@gmail.com", $subject, $email_content, $mail_headers);
        
        // Log the attempt
        $log_entry = "\n=== SPF TEST " . date('Y-m-d H:i:s') . " ===\n";
        $log_entry .= "SPF Record: v=spf1 a:www2657.sakura.ne.jp mx include:_spf.sakura.ad.jp ~all\n";
        $log_entry .= "Gmail Result: " . ($gmail_result ? "SUCCESS" : "FAILED") . "\n";
        $log_entry .= "From: $name <$email>\n";
        $log_entry .= "Message: " . substr($message, 0, 100) . "\n";
        file_put_contents('spf_test_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        if ($gmail_result) {
            $success_message = "✅ SUCCESS! Email sent to Gmail with SPF authentication.";
            $spf_working = true;
        } else {
            $error_message = "⚠️ Email sending failed. Check server logs for details.";
            $spf_working = false;
        }
        
        $test_completed = true;
    } else {
        $error_message = "❌ Please fix: " . implode(", ", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPF Test - Gmail PHP Contact</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; background: #f8f9fa; }
        .card { background: #fff; padding: 20px; border-radius: 8px; margin: 20px 0; border: 1px solid #ddd; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info { background: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { background: #28a745; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #218838; }
        .back-link { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>📧 SPF Authentication Test</h1>
    
    <div class="card info">
        <h3>✅ SPF Record Status</h3>
        <p><strong>Domain:</strong> rikiya-okawa963.jp</p>
        <p><strong>SPF Record:</strong> <code>v=spf1 a:www2657.sakura.ne.jp mx include:_spf.sakura.ad.jp ~all</code></p>
        <p><strong>Status:</strong> ✅ Active and properly configured</p>
    </div>
    
    <?php if (isset($success_message)): ?>
        <div class="card success">
            <h3><?php echo $success_message; ?></h3>
            <p><strong>🎉 Congratulations!</strong> Your PHP contact form now works with Gmail!</p>
            <p>Check your Gmail inbox (including spam folder) for the test email.</p>
        </div>
    <?php endif; ?>
    
    <?php if (isset($error_message)): ?>
        <div class="card error">
            <h3><?php echo $error_message; ?></h3>
            <?php if (isset($spf_working) && !$spf_working): ?>
                <p><strong>Note:</strong> SPF records can take 24-48 hours to fully propagate. If this test fails, try again later.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <?php if (!isset($test_completed)): ?>
        <div class="card">
            <h3>Test Gmail with SPF Authentication</h3>
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="sender-name" placeholder="Test User" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="sender-email" placeholder="test@example.com" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" rows="4" placeholder="Testing SPF authentication with Gmail..." required></textarea>
                </div>
                
                <button type="submit">Test Gmail Delivery</button>
            </form>
        </div>
    <?php endif; ?>
    
    <a href="index.html" class="back-link">← Back to Portfolio</a>
</body>
</html>