# Eucalyptus Wedding Invitation Website

A beautiful, modern PHP-based wedding invitation website with SMTP email functionality for RSVP management.

## Features

- 🌿 **Elegant Eucalyptus Theme**: Modern, clean design inspired by natural eucalyptus elements
- 📱 **Fully Responsive**: Works perfectly on desktop, tablet, and mobile devices
- ⏰ **Live Countdown Timer**: Real-time countdown to the wedding day
- 📧 **SMTP Email Integration**: Automatic RSVP notifications via email
- 🎨 **Modern UI/UX**: Smooth animations, hover effects, and intuitive navigation
- 📝 **Comprehensive RSVP Form**: Collects guest details, dietary requirements, and special messages
- 🔒 **Security Features**: Input validation, sanitization, and error handling
- 🎯 **SEO Optimized**: Proper meta tags and semantic HTML structure

## File Structure

```
eucalyptus-wedding/
├── index.php                 # Main wedding invitation page
├── process_rsvp.php          # RSVP form processing
├── includes/
│   ├── config.php            # Configuration and SMTP settings
│   └── send_email.php        # Email sending functionality
├── assets/
│   ├── css/
│   │   └── style.css         # Modern responsive styling
│   └── js/
│       └── scripts.js        # Interactive functionality
├── logs/                     # Error logs directory
└── README.md                 # This file
```

## Installation & Setup

### 1. Upload Files
Upload all files to your web server's public directory (e.g., `public_html`, `www`, or `htdocs`).

### 2. Configure SMTP Settings
Edit `includes/config.php` and update the following settings:

```php
// SMTP Configuration - UPDATE THESE WITH YOUR ACTUAL CREDENTIALS
$smtp_host = 'smtp.gmail.com';           // Your SMTP host
$smtp_username = 'your-email@gmail.com'; // Your email address
$smtp_password = 'your-app-password';    // Your email password or app password
$smtp_port = 587;                        // SMTP port (587 for TLS, 465 for SSL)
$smtp_secure = 'tls';                    // Security type ('tls' or 'ssl')

// Email Settings
$organizer_email = 'organizer@example.com';  // Where RSVP notifications will be sent
$organizer_name = 'Emma & John Wedding';

// Wedding Details
$wedding_date = '2026-08-16';  // Format: YYYY-MM-DD
$wedding_time = '15:04';       // Format: HH:MM (24-hour)
$wedding_venue = 'Beautiful Garden Venue';
```

### 3. Set Directory Permissions
Ensure the `logs/` directory is writable:
```bash
chmod 755 logs/
```

### 4. Test Email Functionality
You can test the email configuration by accessing `includes/send_email.php` directly in your browser and uncommenting the test email function.

## SMTP Configuration Examples

### Gmail
```php
$smtp_host = 'smtp.gmail.com';
$smtp_username = 'your-email@gmail.com';
$smtp_password = 'your-app-password';  // Use App Password, not regular password
$smtp_port = 587;
$smtp_secure = 'tls';
```

### Outlook/Hotmail
```php
$smtp_host = 'smtp-mail.outlook.com';
$smtp_username = 'your-email@outlook.com';
$smtp_password = 'your-password';
$smtp_port = 587;
$smtp_secure = 'tls';
```

### Custom Hosting Provider
```php
$smtp_host = 'mail.yourdomain.com';
$smtp_username = 'noreply@yourdomain.com';
$smtp_password = 'your-password';
$smtp_port = 587;  // Check with your hosting provider
$smtp_secure = 'tls';
```

## PHPMailer Integration (Recommended)

For better email delivery and more features, install PHPMailer:

### Option 1: Composer (Recommended)
```bash
composer require phpmailer/phpmailer
```

### Option 2: Manual Installation
1. Download PHPMailer from: https://github.com/PHPMailer/PHPMailer
2. Extract to a `PHPMailer/` directory in your project root
3. Uncomment the PHPMailer includes in `includes/send_email.php`

## Customization

### Wedding Details
Update the wedding information in `includes/config.php`:
- Couple names
- Wedding date and time
- Venue information
- Contact details

### Styling
Modify `assets/css/style.css` to customize:
- Colors and fonts
- Layout and spacing
- Animations and effects
- Responsive breakpoints

### Content
Edit `index.php` to update:
- Story sections
- Photo placeholders
- Timeline events
- RSVP form fields

## Features Overview

### Navigation
- Fixed navigation bar with smooth scrolling
- Responsive mobile menu
- Active section highlighting

### Hero Section
- Elegant couple names display
- Wedding date and tagline
- Decorative eucalyptus elements

### Countdown Timer
- Real-time countdown to wedding day
- Animated number changes
- Celebration message after the date

### Couple Stories
- Individual story sections for bride and groom
- Photo placeholders with elegant frames
- Responsive card layouts

### Timeline
- Interactive wedding timeline
- Key milestone highlights
- Smooth animations

### Photo Gallery
- Responsive grid layout
- Hover effects
- Placeholder system for easy image replacement

### Event Details
- Date, time, and venue information
- Interactive detail cards
- Venue description section

### RSVP Form
- Comprehensive guest information collection
- Real-time form validation
- Attendance selection with conditional fields
- Dietary requirements and special messages
- Email notifications to organizers

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Security Features

- Input sanitization and validation
- CSRF protection considerations
- Error logging without information disclosure
- Secure email handling

## Troubleshooting

### Email Not Sending
1. Check SMTP credentials in `config.php`
2. Verify your email provider allows SMTP access
3. For Gmail, use App Passwords instead of regular passwords
4. Check the `logs/error.log` file for detailed error messages
5. Test with the built-in PHP `mail()` function as fallback

### Styling Issues
1. Clear browser cache
2. Check CSS file path in `index.php`
3. Verify file permissions
4. Test in different browsers

### JavaScript Not Working
1. Check browser console for errors
2. Verify JS file path in `index.php`
3. Ensure all required elements exist in HTML

## Performance Optimization

- Optimize images before uploading
- Enable gzip compression on your server
- Use a CDN for static assets
- Minify CSS and JavaScript for production

## License

This project is open source and available under the MIT License.

## Support

For support and customization requests, please check the documentation or contact your web developer.

---

**Made with ❤️ for Emma & John's Special Day**
