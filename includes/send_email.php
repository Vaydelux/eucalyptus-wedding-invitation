<?php
/**
 * Email sending functionality using PHPMailer
 * This file handles SMTP email sending for RSVP notifications
 */

require_once 'config.php';

// PHPMailer classes - using the built-in PHP mail() function as fallback
// For production, download PHPMailer from https://github.com/PHPMailer/PHPMailer
// and uncomment the lines below:
/*
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
*/

/**
 * Send email using SMTP
 * 
 * @param string $to Recipient email address
 * @param string $subject Email subject
 * @param string $body HTML email body
 * @param string $from_name Sender name (optional)
 * @return bool True if email sent successfully, false otherwise
 */
function sendEmail($to, $subject, $body, $from_name = null) {
    global $smtp_host, $smtp_username, $smtp_password, $smtp_port, $smtp_secure, $organizer_name;
    
    $from_name = $from_name ?: $organizer_name;
    
    // Method 1: Using PHPMailer (recommended for production)
    if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        return sendEmailWithPHPMailer($to, $subject, $body, $from_name);
    }
    
    // Method 2: Fallback using PHP's built-in mail() function
    return sendEmailWithBuiltIn($to, $subject, $body, $from_name);
}

/**
 * Send email using PHPMailer (recommended method)
 */
function sendEmailWithPHPMailer($to, $subject, $body, $from_name) {
    global $smtp_host, $smtp_username, $smtp_password, $smtp_port, $smtp_secure;
    
    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        // Server settings
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = $smtp_secure;
        $mail->Port = $smtp_port;
        
        // Recipients
        $mail->setFrom($smtp_username, $from_name);
        $mail->addAddress($to);
        $mail->addReplyTo($smtp_username, $from_name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = strip_tags($body);
        
        $mail->send();
        return true;
        
    } catch (Exception $e) {
        error_log("PHPMailer Error: {$mail->ErrorInfo}");
        return false;
    }
}

/**
 * Fallback email method using PHP's built-in mail() function
 * Note: This method may not work on all hosting providers
 */
function sendEmailWithBuiltIn($to, $subject, $body, $from_name) {
    global $smtp_username;
    
    try {
        // Email headers
        $headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            "From: {$from_name} <{$smtp_username}>",
            "Reply-To: {$smtp_username}",
            'X-Mailer: PHP/' . phpversion()
        ];
        
        $headers_string = implode("\r\n", $headers);
        
        // Send email
        $result = mail($to, $subject, $body, $headers_string);
        
        if (!$result) {
            throw new Exception('Built-in mail() function failed');
        }
        
        return true;
        
    } catch (Exception $e) {
        error_log("Built-in Mail Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Send a test email to verify SMTP configuration
 * 
 * @param string $test_email Email address to send test to
 * @return bool True if test email sent successfully
 */
function sendTestEmail($test_email) {
    $subject = "SMTP Configuration Test - Emma & John Wedding";
    $body = "
    <html>
    <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
        <h2 style='color: #2c7d59;'>SMTP Test Email</h2>
        <p>This is a test email to verify your SMTP configuration is working correctly.</p>
        <p><strong>Sent:</strong> " . date('F j, Y \a\t g:i A') . "</p>
        <p>If you received this email, your SMTP settings are configured properly!</p>
        <hr>
        <p style='color: #666; font-size: 12px;'>Emma & John Wedding Invitation System</p>
    </body>
    </html>";
    
    return sendEmail($test_email, $subject, $body);
}

/**
 * Validate email address format
 * 
 * @param string $email Email address to validate
 * @return bool True if valid email format
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Create a simple email template
 * 
 * @param string $title Email title
 * @param string $content Email content
 * @param string $footer_text Footer text (optional)
 * @return string HTML email template
 */
function createEmailTemplate($title, $content, $footer_text = null) {
    $footer_text = $footer_text ?: "Emma & John Wedding";
    
    return "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body { 
                font-family: 'Arial', sans-serif; 
                line-height: 1.6; 
                color: #333; 
                margin: 0; 
                padding: 0; 
                background-color: #f4f4f4; 
            }
            .container { 
                max-width: 600px; 
                margin: 0 auto; 
                background-color: #ffffff; 
                box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            }
            .header { 
                background: linear-gradient(135deg, #2c7d59, #4a9d6f); 
                color: white; 
                padding: 30px 20px; 
                text-align: center; 
            }
            .header h1 { 
                margin: 0; 
                font-size: 24px; 
                font-weight: 300; 
            }
            .content { 
                padding: 30px 20px; 
            }
            .footer { 
                background-color: #f8f9fa; 
                padding: 20px; 
                text-align: center; 
                color: #666; 
                font-size: 14px; 
                border-top: 1px solid #e9ecef; 
            }
            .eucalyptus-accent { 
                color: #2c7d59; 
                font-weight: bold; 
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>{$title}</h1>
            </div>
            <div class='content'>
                {$content}
            </div>
            <div class='footer'>
                <p>{$footer_text}</p>
                <p style='margin: 5px 0 0 0; font-size: 12px;'>Sent on " . date('F j, Y') . "</p>
            </div>
        </div>
    </body>
    </html>";
}

// Example usage and testing functions
if (basename(__FILE__) == basename($_SERVER['SCRIPT_NAME'])) {
    // This code runs only when the file is accessed directly (for testing)
    echo "<h2>Email Configuration Test</h2>";
    echo "<p>This file contains email sending functions for the wedding invitation.</p>";
    echo "<p>To test your SMTP configuration, you can call the sendTestEmail() function.</p>";
    
    // Uncomment the line below and add your test email to send a test email
    // $test_result = sendTestEmail('your-test-email@example.com');
    // echo $test_result ? "<p style='color: green;'>Test email sent successfully!</p>" : "<p style='color: red;'>Test email failed to send.</p>";
}
?>
