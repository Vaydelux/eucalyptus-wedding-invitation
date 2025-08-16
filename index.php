<?php
require_once 'includes/config.php';

// Handle success/error messages
$message = '';
$message_type = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] === 'success') {
        $message = 'Thank you! Your RSVP has been sent successfully.';
        $message_type = 'success';
    } elseif ($_GET['status'] === 'error') {
        $message = 'There was an error sending your RSVP. Please try again.';
        $message_type = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title; ?></title>
    <meta name="description" content="Elegant eucalyptus-themed wedding invitation for Emma & John">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="#home" class="nav-link">The Two of Us</a></li>
                <li><a href="#story" class="nav-link">Our Story</a></li>
                <li><a href="#details" class="nav-link">When and Where</a></li>
                <li><a href="#rsvp" class="nav-link rsvp-btn">RSVP</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <div class="eucalyptus-decoration top"></div>
            <h1 class="couple-names">Emma & John</h1>
            <p class="wedding-tagline">Love Unites Us, 16 AUGUST 2026</p>
            <div class="eucalyptus-decoration bottom"></div>
        </div>
        <div class="hero-image">
            <div class="image-frame">
                <div class="placeholder-image couple-photo"></div>
            </div>
        </div>
        <div class="scroll-indicator">
            <span>Scroll to explore</span>
        </div>
    </section>

    <!-- Countdown Section -->
    <section class="countdown-section">
        <div class="container">
            <div class="countdown-grid">
                <div class="countdown-item">
                    <div class="eucalyptus-wreath">
                        <span id="days" class="countdown-number">364</span>
                        <span class="countdown-label">days</span>
                    </div>
                </div>
                <div class="countdown-item">
                    <div class="eucalyptus-wreath">
                        <span id="hours" class="countdown-number">23</span>
                        <span class="countdown-label">hours</span>
                    </div>
                </div>
                <div class="countdown-item">
                    <div class="eucalyptus-wreath">
                        <span id="minutes" class="countdown-number">59</span>
                        <span class="countdown-label">minutes</span>
                    </div>
                </div>
                <div class="countdown-item">
                    <div class="eucalyptus-wreath">
                        <span id="seconds" class="countdown-number">4</span>
                        <span class="countdown-label">seconds</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Couple Stories Section -->
    <section class="couple-stories">
        <div class="container">
            <!-- Emma's Story -->
            <div class="story-card emma-story">
                <div class="story-image">
                    <div class="placeholder-image emma-photo"></div>
                </div>
                <div class="story-content">
                    <span class="story-label">SMITH</span>
                    <h3 class="story-name">EMMA</h3>
                    <p class="story-text">I have always brought color and creativity to those around me. Every detail for me is an opportunity to create something beautiful. I hope my smile brings you light and joy on our special day.</p>
                </div>
            </div>

            <!-- John's Story -->
            <div class="story-card john-story">
                <div class="story-image">
                    <div class="placeholder-image john-photo"></div>
                </div>
                <div class="story-content">
                    <span class="story-label">DOE</span>
                    <h3 class="story-name">JOHN</h3>
                    <p class="story-text">I've always been passionate about music and nature, the life of the party, ready to turn any moment into an unforgettable memory. Adventure has taken me through wonderful places, but none compare to the moment I met Emma.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section id="story" class="our-story">
        <div class="container">
            <h2 class="section-title">Our Story</h2>
            <p class="section-subtitle">How We Met and Decided to Journey Through Life Together</p>
            
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year active">2021</div>
                    <div class="timeline-content">
                        <h4>First Meeting</h4>
                        <p>We met at a coffee shop on a rainy Tuesday morning. What started as a chance encounter became the beginning of our beautiful love story.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h4>Moving In Together</h4>
                        <p>After two years of dating, we decided to take the next step and move in together. Our little apartment became our sanctuary.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year highlight">2025</div>
                    <div class="timeline-content">
                        <h4>The Proposal</h4>
                        <p>On a beautiful sunset evening in our favorite park, John got down on one knee and asked Emma to be his wife. She said yes!</p>
                    </div>
                </div>
            </div>

            <div class="story-image-large">
                <div class="placeholder-image story-photo"></div>
            </div>

            <div class="adventures-section">
                <h3>Adventures Together</h3>
                <p class="adventures-subtitle">Exploring the World, Discovering Each Other</p>
                <p class="adventures-text">Every trip we've taken together has been an opportunity to discover the beauty of the world and the depths of our love. From the eternal snows of the Alps to the golden beaches of Greece, each adventure has strengthened our bond and prepared us for the journey of life as husband and wife.</p>
            </div>
        </div>
    </section>

    <!-- Photo Gallery Section -->
    <section class="photo-gallery">
        <div class="container">
            <h2 class="section-title">Precious Memories</h2>
            <p class="section-subtitle">Unique Moments from Our Lives</p>
            
            <div class="gallery-grid">
                <div class="gallery-item">
                    <div class="placeholder-image gallery-photo"></div>
                </div>
                <div class="gallery-item">
                    <div class="placeholder-image gallery-photo"></div>
                </div>
                <div class="gallery-item">
                    <div class="placeholder-image gallery-photo"></div>
                </div>
                <div class="gallery-item">
                    <div class="placeholder-image gallery-photo"></div>
                </div>
                <div class="gallery-item large">
                    <div class="placeholder-image gallery-photo"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Details Section -->
    <section id="details" class="event-details">
        <div class="container">
            <h2 class="section-title">When and Where</h2>
            
            <div class="details-grid">
                <div class="detail-card">
                    <div class="detail-icon">📅</div>
                    <h3>Date</h3>
                    <p><?php echo date('F j, Y', strtotime($wedding_date)); ?></p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon">🕐</div>
                    <h3>Time</h3>
                    <p><?php echo date('g:i A', strtotime($wedding_time)); ?></p>
                </div>
                <div class="detail-card">
                    <div class="detail-icon">📍</div>
                    <h3>Venue</h3>
                    <p><?php echo $wedding_venue; ?></p>
                    <p class="venue-address">123 Garden Lane, Beautiful City</p>
                </div>
            </div>

            <div class="venue-info">
                <h3>Venue Details</h3>
                <p>Join us at our beautiful garden venue surrounded by nature's elegance. The ceremony will take place in the outdoor pavilion, followed by dinner and dancing under the stars.</p>
            </div>
        </div>
    </section>

    <!-- RSVP Section -->
    <section id="rsvp" class="rsvp-section">
        <div class="container">
            <h2 class="section-title">We Look Forward to Your Confirmation</h2>
            <p class="section-subtitle">Every detail matters to us, and your presence is the most precious gift. Please confirm your attendance by July 1, 2025, to ensure everything is as we have dreamed.</p>
            <p class="rsvp-help">Help us plan the perfect day</p>

            <?php if ($message): ?>
                <div class="message <?php echo $message_type; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <div class="rsvp-form-container">
                <form class="rsvp-form" action="process_rsvp.php" method="POST">
                    <div class="form-group">
                        <label for="guest_name">Full Name *</label>
                        <input type="text" id="guest_name" name="guest_name" required>
                    </div>

                    <div class="form-group">
                        <label for="guest_email">Email Address *</label>
                        <input type="email" id="guest_email" name="guest_email" required>
                    </div>

                    <div class="form-group">
                        <label for="guest_phone">Phone Number</label>
                        <input type="tel" id="guest_phone" name="guest_phone">
                    </div>

                    <div class="form-group">
                        <label>Will you be attending? *</label>
                        <div class="attendance-options">
                            <div class="attendance-option">
                                <input type="radio" id="attending_yes" name="attendance" value="yes" required>
                                <label for="attending_yes" class="attendance-label">
                                    <span class="attendance-icon">👍</span>
                                    <span>Yes, I will attend</span>
                                </label>
                            </div>
                            <div class="attendance-option">
                                <input type="radio" id="attending_no" name="attendance" value="no" required>
                                <label for="attending_no" class="attendance-label">
                                    <span class="attendance-icon">👎</span>
                                    <span>No, I will not be able to attend</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="guest_count">Number of Guests</label>
                        <select id="guest_count" name="guest_count">
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dietary_requirements">Dietary Requirements</label>
                        <textarea id="dietary_requirements" name="dietary_requirements" rows="3" placeholder="Please let us know about any dietary restrictions or allergies"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="message">Special Message</label>
                        <textarea id="message" name="message" rows="4" placeholder="Share your wishes or any special message for the couple"></textarea>
                    </div>

                    <button type="submit" class="rsvp-submit-btn">Send RSVP</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2024 Emma & John Wedding. Made with love.</p>
                <div class="eucalyptus-decoration small"></div>
            </div>
        </div>
    </footer>

    <script src="assets/js/scripts.js"></script>
    <script>
        // Initialize countdown with wedding date
        document.addEventListener('DOMContentLoaded', function() {
            const weddingDate = new Date('<?php echo $wedding_date; ?>T<?php echo $wedding_time; ?>:00');
            initCountdown(weddingDate);
        });
    </script>
</body>
</html>
