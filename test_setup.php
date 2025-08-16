<?php
/**
 * Setup Test File for Eucalyptus Wedding Invitation
 * This file helps verify that everything is configured correctly
 */

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Setup Test - Eucalyptus Wedding</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .test-item { margin: 20px 0; padding: 15px; border-radius: 5px; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .warning { background-color: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info { background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        h1 { color: #2c3e50; text-align: center; }
        h2 { color: #27ae60; border-bottom: 2px solid #27ae60; padding-bottom: 5px; }
        code { background-color: #f8f9fa; padding: 2px 5px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>🌿 Eucalyptus Wedding Invitation - Setup Test</h1>";

// Test 1: PHP Version
echo "<h2>1. PHP Environment</h2>";
$phpVersion = phpversion();
if (version_compare($phpVersion, '7.4', '>=')) {
    echo "<div class='test-item success'>✅ PHP Version: $phpVersion (Compatible)</div>";
} else {
    echo "<div class='test-item warning'>⚠️ PHP Version: $phpVersion (Recommended: 7.4+)</div>";
}

// Test 2: Required Extensions
echo "<h2>2. PHP Extensions</h2>";
$extensions = ['curl', 'openssl', 'mbstring', 'filter'];
foreach ($extensions as $ext) {
    if (extension_loaded($ext)) {
        echo "<div class='test-item success'>✅ Extension '$ext' is loaded</div>";
    } else {
        echo "<div class='test-item error'>❌ Extension '$ext' is missing</div>";
    }
}

// Test 3: File Structure
echo "<h2>3. File Structure</h2>";
$requiredFiles = [
    'index.php' => 'Main invitation page',
    'process_rsvp.php' => 'RSVP processing script',
    'includes/config.php' => 'Configuration file',
    'includes/send_email.php' => 'Email functionality',
    'assets/css/style.css' => 'Stylesheet',
    'assets/js/scripts.js' => 'JavaScript file',
    'logs/' => 'Logs directory'
];

foreach ($requiredFiles as $file => $description) {
    if (file_exists($file)) {
        $isWritable = is_dir($file) ? is_writable($file) : is_readable($file);
        $status = $isWritable ? '✅' : '⚠️';
        $class = $isWritable ? 'success' : 'warning';
        echo "<div class='test-item $class'>$status $description: <code>$file</code></div>";
    } else {
        echo "<div class='test-item error'>❌ Missing: <code>$file</code> - $description</div>";
    }
}

// Test 4: Configuration
echo "<h2>4. Configuration Status</h2>";
if (file_exists('includes/config.php')) {
    require_once 'includes/config.php';
    
    // Check if SMTP settings are configured
    if (isset($smtp_host) && $smtp_host !== 'smtp.gmail.com') {
        echo "<div class='test-item success'>✅ SMTP Host configured: $smtp_host</div>";
    } else {
        echo "<div class='test-item warning'>⚠️ SMTP Host not configured (using default)</div>";
    }
    
    if (isset($smtp_username) && $smtp_username !== 'your-email@gmail.com') {
        echo "<div class='test-item success'>✅ SMTP Username configured</div>";
    } else {
        echo "<div class='test-item warning'>⚠️ SMTP Username not configured</div>";
    }
    
    if (isset($organizer_email) && $organizer_email !== 'organizer@example.com') {
        echo "<div class='test-item success'>✅ Organizer email configured: $organizer_email</div>";
    } else {
        echo "<div class='test-item warning'>⚠️ Organizer email not configured</div>";
    }
    
    if (isset($wedding_date)) {
        echo "<div class='test-item info'>📅 Wedding Date: " . date('F j, Y', strtotime($wedding_date)) . "</div>";
    }
    
    if (isset($wedding_venue)) {
        echo "<div class='test-item info'>📍 Wedding Venue: $wedding_venue</div>";
    }
} else {
    echo "<div class='test-item error'>❌ Configuration file not found</div>";
}

// Test 5: Email Function Test
echo "<h2>5. Email Function Test</h2>";
if (file_exists('includes/send_email.php')) {
    require_once 'includes/send_email.php';
    
    if (function_exists('sendEmail')) {
        echo "<div class='test-item success'>✅ Email function is available</div>";
        echo "<div class='test-item info'>ℹ️ To test email sending, uncomment the test code in send_email.php</div>";
    } else {
        echo "<div class='test-item error'>❌ Email function not found</div>";
    }
} else {
    echo "<div class='test-item error'>❌ Email script not found</div>";
}

// Test 6: Permissions
echo "<h2>6. Directory Permissions</h2>";
$directories = ['logs/', 'assets/', 'includes/'];
foreach ($directories as $dir) {
    if (is_dir($dir)) {
        if (is_writable($dir)) {
            echo "<div class='test-item success'>✅ Directory '$dir' is writable</div>";
        } else {
            echo "<div class='test-item warning'>⚠️ Directory '$dir' is not writable</div>";
        }
    }
}

// Next Steps
echo "<h2>7. Next Steps</h2>";
echo "<div class='test-item info'>
    <strong>To complete the setup:</strong><br>
    1. Update SMTP settings in <code>includes/config.php</code><br>
    2. Customize wedding details (names, date, venue)<br>
    3. Replace photo placeholders with actual images<br>
    4. Test the RSVP form functionality<br>
    5. Remove this test file before going live
</div>";

echo "<div class='test-item success'>
    <strong>Ready to view your invitation?</strong><br>
    <a href='index.php' style='color: #27ae60; font-weight: bold;'>🌿 View Wedding Invitation</a>
</div>";

echo "</body></html>";
?>
