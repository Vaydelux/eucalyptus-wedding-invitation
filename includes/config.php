<?php
/**
 * Eucalyptus Wedding Invitation - Configuration File
 * Update the SMTP settings below with your actual credentials
 */

// Enable error logging (disable display_errors in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

// SMTP Configuration - UPDATE THESE WITH YOUR ACTUAL CREDENTIALS
$smtp_host = 'smtp.gmail.com';  // Change to your SMTP host
$smtp_username = 'your-email@gmail.com';  // Change to your email
$smtp_password = 'your-app-password';  // Change to your password/app password
$smtp_port = 587;  // 587 for TLS, 465 for SSL
$smtp_secure = 'tls';  // 'tls' or 'ssl'

// Email Settings
$organizer_email = 'organizer@example.com';  // Where RSVP notifications will be sent
$organizer_name = 'Emma & John Wedding';

// Site Settings
$site_title = 'Emma & John - Wedding Invitation';
$wedding_date = '2026-08-16';  // Format: YYYY-MM-DD
$wedding_time = '15:04';
$wedding_venue = 'Beautiful Garden Venue';
