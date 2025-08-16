<?php
require_once 'includes/config.php';
require_once 'includes/send_email.php';

// Start session for error handling
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Sanitize and validate input data
$guest_name = filter_input(INPUT_POST, 'guest_name', FILTER_SANITIZE_STRING);
$guest_email = filter_input(INPUT_POST, 'guest_email', FILTER_VALIDATE_EMAIL);
$guest_phone = filter_input(INPUT_POST, 'guest_phone', FILTER_SANITIZE_STRING);
$attendance = filter_input(INPUT_POST, 'attendance', FILTER_SANITIZE_STRING);
$guest_count = filter_input(INPUT_POST, 'guest_count', FILTER_SANITIZE_NUMBER_INT);
$dietary_requirements = filter_input(INPUT_POST, 'dietary_requirements', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

// Validation
$errors = [];

if (empty($guest_name)) {
    $errors[] = 'Name is required';
}

if (empty($guest_email)) {
    $errors[] = 'Valid email is required';
}

if (empty($attendance) || !in_array($attendance, ['yes', 'no'])) {
    $errors[] = 'Please select your attendance status';
}

if (!empty($errors)) {
    $_SESSION['rsvp_errors'] = $errors;
    header('Location: index.php?status=error');
    exit;
}

// Prepare email content
$attendance_text = ($attendance === 'yes') ? 'Will Attend' : 'Will Not Attend';
$guest_count = $guest_count ?: 1;

$subject = "New RSVP from {$guest_name} - {$attendance_text}";

$email_body = "
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background-color: #2c7d59; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #2c7d59; }
        .value { margin-left: 10px; }
        .attendance-yes { color: #28a745; font-weight: bold; }
        .attendance-no { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
    <div class='header'>
        <h2>New RSVP Received</h2>
        <p>Emma & John Wedding Invitation</p>
    </div>
    <div class='content'>
        <div class='field'>
            <span class='label'>Guest Name:</span>
            <span class='value'>{$guest_name}</span>
        </div>
        <div class='field'>
            <span class='label'>Email:</span>
            <span class='value'>{$guest_email}</span>
        </div>";

if (!empty($guest_phone)) {
    $email_body .= "
        <div class='field'>
            <span class='label'>Phone:</span>
            <span class='value'>{$guest_phone}</span>
        </div>";
}

$attendance_class = ($attendance === 'yes') ? 'attendance-yes' : 'attendance-no';
$email_body .= "
        <div class='field'>
            <span class='label'>Attendance:</span>
            <span class='value {$attendance_class}'>{$attendance_text}</span>
        </div>";

if ($attendance === 'yes') {
    $email_body .= "
        <div class='field'>
            <span class='label'>Number of Guests:</span>
            <span class='value'>{$guest_count}</span>
        </div>";
}

if (!empty($dietary_requirements)) {
    $email_body .= "
        <div class='field'>
            <span class='label'>Dietary Requirements:</span>
            <span class='value'>{$dietary_requirements}</span>
        </div>";
}

if (!empty($message)) {
    $email_body .= "
        <div class='field'>
            <span class='label'>Message:</span>
            <span class='value'>{$message}</span>
        </div>";
}

$email_body .= "
        <div class='field'>
            <span class='label'>Submitted:</span>
            <span class='value'>" . date('F j, Y \a\t g:i A') . "</span>
        </div>
    </div>
</body>
</html>";

// Send email
try {
    $email_sent = sendEmail($organizer_email, $subject, $email_body);
    
    if ($email_sent) {
        // Log successful RSVP
        error_log("RSVP received from {$guest_name} ({$guest_email}) - {$attendance_text}");
        header('Location: index.php?status=success');
    } else {
        throw new Exception('Failed to send email');
    }
} catch (Exception $e) {
    error_log("RSVP Error: " . $e->getMessage());
    header('Location: index.php?status=error');
}

exit;
?>
