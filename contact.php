<?php
/* ==========================================================================
   CONTACT FORM (contact.php)
   Simple PHP Code for Viva Examination Preparation
   ========================================================================== */

require_once 'includes/db.php';
require_once 'includes/functions.php';

$successMsg = '';
$errorMsg = '';

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = sanitize_input($_POST['name'] ?? '');
    $email   = sanitize_input($_POST['email'] ?? '');
    $message = sanitize_input($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $errorMsg = "Please fill out all fields!";
    } else {
        // Insert message into MySQL 'messages' table using Prepared Statements (Security against SQL Injection)
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $message])) {
            $successMsg = "Thank you, $name! Your message has been sent successfully.";
        } else {
            $errorMsg = "Failed to send message. Please try again.";
        }
    }
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Digital Recipe Book</title>
    <base href="<?php echo htmlspecialchars($base_path, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .contact-section { padding: 60px 0; min-height: 80vh; display: flex; align-items: center; }
        .contact-card { background: #ffffff; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); max-width: 600px; margin: 0 auto; width: 100%; border: 1px solid #e2e8f0; }
        .contact-title { font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 800; color: #1e252b; margin-bottom: 10px; text-align: center; }
        .contact-subtitle { color: #64748b; text-align: center; margin-bottom: 24px; font-size: 0.95rem; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-weight: 700; font-size: 0.88rem; margin-bottom: 6px; color: #1e252b; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-family: inherit; font-size: 0.95rem; box-sizing: border-box; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: #00a843; box-shadow: 0 0 0 3px rgba(0,168,67,0.15); }
        .btn-submit { width: 100%; background: #00a843; color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.2s; }
        .btn-submit:hover { background: #008f39; }
        .alert { padding: 12px; border-radius: 8px; font-size: 0.9rem; margin-bottom: 20px; text-align: center; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-danger { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
</head>
<body style="background-color: #f8fafc;">

    <!-- Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="index.php" class="brand-logo">
                <svg viewBox="0 0 40 40" fill="none" width="38" height="38">
                    <path d="M20 5C14.4772 5 10 9.47715 10 15C10 17.5 10.9 19.8 12.4 21.5C9.5 22.8 7.5 25.6 7.5 29H32.5C32.5 25.6 30.5 22.8 27.6 21.5C29.1 19.8 30 17.5 30 15C30 9.47715 25.5228 5 20 5Z" fill="#257838"/>
                    <path d="M8 29H32V32C32 33.6569 30.6569 35 29 35H11C9.34315 35 8 33.6569 8 32V29Z" fill="#EE5D20"/>
                </svg>
                <div class="logo-text">
                    <span class="text-green">Digital</span>
                    <span class="text-orange">Recipe Book</span>
                </div>
            </a>
            <nav class="nav-links">
                <a href="index.php" class="nav-link">Home</a>
                <a href="recipes.html" class="nav-link">Recipes</a>
                <a href="contact.php" class="nav-link active">Contact</a>
            </nav>
            <div class="nav-actions">
                <button class="search-trigger-btn" id="searchTriggerBtn" title="Search Recipes (Ctrl+K)">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <?php if (is_logged_in()): ?>
                    <a href="dashboard.php" class="login-btn" style="background:#00a843; display:inline-flex; align-items:center; gap:8px;">
                        <i class="fa-solid fa-circle-user"></i>
                        <span><?php echo htmlspecialchars($_SESSION['username'] ?? 'Profile'); ?></span>
                    </a>
                    <a href="auth/logout.php" class="login-btn" style="background:#ef4444;">Logout</a>
                <?php else: ?>
                    <a href="auth/login.php" class="login-btn">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="contact-section">
        <div class="container">
            <div class="contact-card">
                <h1 class="contact-title">Get in Touch</h1>
                <p class="contact-subtitle">Have a question, feedback, or a recipe request? Send us a message!</p>

                <?php if (!empty($successMsg)): ?>
                    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo $successMsg; ?></div>
                <?php endif; ?>

                <?php if (!empty($errorMsg)): ?>
                    <div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation"></i> <?php echo $errorMsg; ?></div>
                <?php endif; ?>

                <form action="contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" required placeholder="Kavindu">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required placeholder="kavindu@example.com">
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Write your message here..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fa-solid fa-paper-plane me-2"></i> Send Message</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container footer-container">
            <div>&copy; 2026 Digital Recipe Book. All rights reserved.</div>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <script src="app.js"></script>
</body>
</html>
