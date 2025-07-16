<?php
// Simple test version of contact form - saves to file instead of email
// This lets us test without email server configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get form data
    $name = htmlspecialchars($_POST['sender-name'] ?? '');
    $email = htmlspecialchars($_POST['sender-email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
    // Validate
    $errors = [];
    if (empty($name)) $errors[] = "Name required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email required";
    if (empty($message)) $errors[] = "Message required";
    
    if (empty($errors)) {
        // Save message to file (simulates email sending)
        $timestamp = date('Y-m-d H:i:s');
        $log_entry = "=== Message received at $timestamp ===\n";
        $log_entry .= "Name: $name\n";
        $log_entry .= "Email: $email\n";
        $log_entry .= "Message: $message\n\n";
        
        // Save to messages.txt file
        file_put_contents('messages.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        $success = true;
        $status_message = "✅ Success! Message saved locally. Check messages.txt file.";
    } else {
        $success = false;
        $status_message = "❌ Errors: " . implode(", ", $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Test</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #007bff; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .status { padding: 15px; margin: 20px 0; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info { background: #cce7ff; padding: 15px; margin: 20px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>🧪 Contact Form Test</h1>
    
    <div class="info">
        <strong>Testing Mode:</strong> This saves messages to a file instead of sending emails.
        Perfect for testing before deploying to your Sakura server!
    </div>
    
    <?php if (isset($status_message)): ?>
        <div class="status <?php echo $success ? 'success' : 'error'; ?>">
            <?php echo $status_message; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="sender-name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="sender-email" required>
        </div>
        
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        
        <button type="submit">Send Test Message</button>
    </form>
    
    <hr style="margin: 40px 0;">
    
    <h3>📋 Received Messages:</h3>
    
    <?php
    // Display saved messages
    if (file_exists('messages.txt')) {
        echo "<pre style='background: #f8f9fa; padding: 15px; border-radius: 5px; max-height: 300px; overflow-y: auto;'>";
        echo htmlspecialchars(file_get_contents('messages.txt'));
        echo "</pre>";
    } else {
        echo "<p style='color: #666;'>No messages yet. Submit the form above to test!</p>";
    }
    ?>
    
</body>
</html>