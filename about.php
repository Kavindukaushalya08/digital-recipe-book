<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Digital Recipe Book</title>
    <meta name="description" content="Learn more about Digital Recipe Book, our culinary mission, community of food lovers, and our passionate team.">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="styles.css">

    
    <style>
        :root {
            --primary-green: #257838;
            --primary-green-hover: #1e622d;
            --primary-orange: #ee5d20;
            --text-dark: #1e252b;
            --text-muted: #5a6578;
            --bg-page: #f8faf9;
            --card-bg: #ffffff;
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); background-color: var(--bg-page); color: var(--text-dark); line-height: 1.6; }
        .container { max-width: 1240px; margin: 0 auto; padding: 0 24px; }
        a { text-decoration: none; color: inherit; }

        /* Navigation Bar */
        .navbar { position: sticky; top: 0; background-color: #ffffff; z-index: 1000; border-bottom: 1px solid rgba(0,0,0,0.05); padding: 14px 0; }
        .nav-container { display: flex; align-items: center; justify-content: space-between; }
        .brand-logo { display: flex; align-items: center; gap: 12px; }
        .logo-text { display: flex; flex-direction: column; font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; line-height: 1.1; }
        .text-green { color: var(--primary-green); }
        .text-orange { color: var(--primary-orange); }
        .nav-links { display: flex; align-items: center; gap: 32px; }
        .nav-link { font-weight: 600; font-size: 0.95rem; color: var(--text-muted); padding: 6px 0; }
        .nav-link.active { color: var(--primary-orange); font-weight: 700; border-bottom: 3px solid var(--primary-orange); }
        .login-btn { background-color: var(--primary-orange); color: white; font-weight: 700; padding: 9px 22px; border-radius: 12px; }

        /* About Hero Section */
        .about-hero { background: linear-gradient(135deg, #fff8eb 0%, #fef0d2 50%, #fde7b7 100%); padding: 70px 0; text-align: center; }
        .about-hero-title { font-family: var(--font-heading); font-size: 3rem; font-weight: 800; color: var(--text-dark); margin-bottom: 16px; }
        .about-hero-title span { color: var(--primary-green); }
        .about-hero-sub { font-size: 1.15rem; color: var(--text-muted); max-width: 650px; margin: 0 auto; }

        /* Story & Mission Grid */
        .story-section { padding: 70px 0; }
        .story-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
        .story-content h2 { font-family: var(--font-heading); font-size: 2.2rem; font-weight: 800; color: var(--text-dark); margin-bottom: 20px; }
        .story-content p { color: var(--text-muted); margin-bottom: 18px; font-size: 1.05rem; }
        .story-img-wrap { border-radius: 24px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .story-img-wrap img { width: 100%; height: 380px; object-fit: cover; display: block; }

        /* Core Values Cards */
        .values-section { padding: 60px 0 80px; background: #ffffff; }
        .section-center-head { text-align: center; margin-bottom: 50px; }
        .section-center-head h2 { font-family: var(--font-heading); font-size: 2.2rem; font-weight: 800; margin-bottom: 12px; }
        .values-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
        .value-card { background: #f8fafc; padding: 32px 24px; border-radius: 20px; border: 1px solid #e2e8f0; text-align: center; transition: transform 0.3s ease; }
        .value-card:hover { transform: translateY(-6px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .value-icon { width: 64px; height: 64px; background: #e8f5e9; color: var(--primary-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin: 0 auto 20px; }
        .value-card h3 { font-family: var(--font-heading); font-size: 1.3rem; margin-bottom: 10px; color: var(--text-dark); }
        .value-card p { color: var(--text-muted); font-size: 0.95rem; }

        /* Stats Row */
        .stats-banner { background: var(--primary-green); color: white; padding: 45px 0; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); text-align: center; gap: 20px; }
        .stat-num { font-family: var(--font-heading); font-size: 2.5rem; font-weight: 800; display: block; margin-bottom: 4px; }
        .stat-label { font-size: 1rem; opacity: 0.9; font-weight: 600; }

        /* Footer */
        .footer { background-color: #1a4d25; color: white; padding: 20px 0; }
        .footer-flex { display: flex; align-items: center; justify-content: space-between; }
        .social-icons { display: flex; gap: 16px; font-size: 1.1rem; }

        @media(max-width: 992px) {
            .story-grid { grid-template-columns: 1fr; }
            .values-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; }
        }
    </style>
</head>
<body>

    
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
                <a href="recipes.php" class="nav-link">Recipes</a>
                <a href="about.php" class="nav-link active">About</a>
                <a href="contact.html" class="nav-link">Contact</a>
            </nav>

                        <div class="nav-actions">
                <button class="icon-btn search-trigger-btn" id="searchTriggerBtn" title="Search Recipes (Ctrl+K)"><i class="fa-solid fa-magnifying-glass"></i></button>
                <?php if (is_logged_in()): ?>
                    <a href="dashboard.php" class="login-btn" style="background:#00a843; display:inline-flex; align-items:center; gap:8px; padding: 8px 16px; border-radius: 99px; color: white; font-weight: 600;">
                        <i class="fa-solid fa-circle-user"></i>
                        <span><?php echo htmlspecialchars(<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Digital Recipe Book</title>
    <meta name="description" content="Learn more about Digital Recipe Book, our culinary mission, community of food lovers, and our passionate team.">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="styles.css">

    
    <style>
        :root {
            --primary-green: #257838;
            --primary-green-hover: #1e622d;
            --primary-orange: #ee5d20;
            --text-dark: #1e252b;
            --text-muted: #5a6578;
            --bg-page: #f8faf9;
            --card-bg: #ffffff;
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); background-color: var(--bg-page); color: var(--text-dark); line-height: 1.6; }
        .container { max-width: 1240px; margin: 0 auto; padding: 0 24px; }
        a { text-decoration: none; color: inherit; }

        /* Navigation Bar */
        .navbar { position: sticky; top: 0; background-color: #ffffff; z-index: 1000; border-bottom: 1px solid rgba(0,0,0,0.05); padding: 14px 0; }
        .nav-container { display: flex; align-items: center; justify-content: space-between; }
        .brand-logo { display: flex; align-items: center; gap: 12px; }
        .logo-text { display: flex; flex-direction: column; font-family: var(--font-heading); font-size: 1.25rem; font-weight: 800; line-height: 1.1; }
        .text-green { color: var(--primary-green); }
        .text-orange { color: var(--primary-orange); }
        .nav-links { display: flex; align-items: center; gap: 32px; }
        .nav-link { font-weight: 600; font-size: 0.95rem; color: var(--text-muted); padding: 6px 0; }
        .nav-link.active { color: var(--primary-orange); font-weight: 700; border-bottom: 3px solid var(--primary-orange); }
        .login-btn { background-color: var(--primary-orange); color: white; font-weight: 700; padding: 9px 22px; border-radius: 12px; }

        /* About Hero Section */
        .about-hero { background: linear-gradient(135deg, #fff8eb 0%, #fef0d2 50%, #fde7b7 100%); padding: 70px 0; text-align: center; }
        .about-hero-title { font-family: var(--font-heading); font-size: 3rem; font-weight: 800; color: var(--text-dark); margin-bottom: 16px; }
        .about-hero-title span { color: var(--primary-green); }
        .about-hero-sub { font-size: 1.15rem; color: var(--text-muted); max-width: 650px; margin: 0 auto; }

        /* Story & Mission Grid */
        .story-section { padding: 70px 0; }
        .story-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center; }
        .story-content h2 { font-family: var(--font-heading); font-size: 2.2rem; font-weight: 800; color: var(--text-dark); margin-bottom: 20px; }
        .story-content p { color: var(--text-muted); margin-bottom: 18px; font-size: 1.05rem; }
        .story-img-wrap { border-radius: 24px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .story-img-wrap img { width: 100%; height: 380px; object-fit: cover; display: block; }

        /* Core Values Cards */
        .values-section { padding: 60px 0 80px; background: #ffffff; }
        .section-center-head { text-align: center; margin-bottom: 50px; }
        .section-center-head h2 { font-family: var(--font-heading); font-size: 2.2rem; font-weight: 800; margin-bottom: 12px; }
        .values-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
        .value-card { background: #f8fafc; padding: 32px 24px; border-radius: 20px; border: 1px solid #e2e8f0; text-align: center; transition: transform 0.3s ease; }
        .value-card:hover { transform: translateY(-6px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
        .value-icon { width: 64px; height: 64px; background: #e8f5e9; color: var(--primary-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin: 0 auto 20px; }
        .value-card h3 { font-family: var(--font-heading); font-size: 1.3rem; margin-bottom: 10px; color: var(--text-dark); }
        .value-card p { color: var(--text-muted); font-size: 0.95rem; }

        /* Stats Row */
        .stats-banner { background: var(--primary-green); color: white; padding: 45px 0; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); text-align: center; gap: 20px; }
        .stat-num { font-family: var(--font-heading); font-size: 2.5rem; font-weight: 800; display: block; margin-bottom: 4px; }
        .stat-label { font-size: 1rem; opacity: 0.9; font-weight: 600; }

        /* Footer */
        .footer { background-color: #1a4d25; color: white; padding: 20px 0; }
        .footer-flex { display: flex; align-items: center; justify-content: space-between; }
        .social-icons { display: flex; gap: 16px; font-size: 1.1rem; }

        @media(max-width: 992px) {
            .story-grid { grid-template-columns: 1fr; }
            .values-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; }
        }
    </style>
</head>
<body>

    
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
                <a href="recipes.php" class="nav-link">Recipes</a>
                <a href="about.php" class="nav-link active">About</a>
                <a href="contact.html" class="nav-link">Contact</a>
            </nav>

            <div class="nav-actions">
                <button class="search-trigger-btn" id="searchTriggerBtn" title="Search Recipes (Ctrl+K)" style="background:none; border:none; font-size:1.2rem; cursor:pointer; color:#1e252b; padding:8px; margin-right:8px;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <a href="auth/login.php" class="login-btn"><i class="fa-regular fa-user me-2"></i>Login</a>
            </div>
        </div>
    </header>

    
    <section class="about-hero">
        <div class="container">
            <h1 class="about-hero-title">About <span>Digital Recipe Book</span></h1>
            <p class="about-hero-sub">Empowering food lovers, home cooks, and professional chefs to discover, cook, and share authentic culinary recipes across the globe.</p>
        </div>
    </section>

    
    <section class="story-section">
        <div class="container">
            <div class="story-grid">
                <div class="story-content">
                    <h2>Our Culinary Mission</h2>
                    <p>Cooking is an art that connects families, traditions, and diverse cultures. Digital Recipe Book was created as an interactive, centralized platform designed to eliminate the frustration of scattered, hard-to-follow internet recipes.</p>
                    <p>Whether you are a beginner looking for quick 15-minute breakfast ideas or an experienced chef experimenting with international cuisines, our platform provides step-by-step guides, precise ingredient measurements, and community-shared cooking secrets.</p>
                </div>
                <div class="story-img-wrap">
                    <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=1000&auto=format&fit=crop" 
                         onerror="this.src='assets/images/hero_pasta_dish.jpg';" 
                         alt="Cooking Together in Kitchen">
                </div>
            </div>
        </div>
    </section>

    
    <section class="values-section">
        <div class="container">
            <div class="section-center-head">
                <h2>Why Choose Digital Recipe Book?</h2>
                <p style="color: #64748b;">Built with modern web standards and designed for food enthusiasts everywhere.</p>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-utensils"></i></div>
                    <h3>Curated Recipes</h3>
                    <p>Every dish is carefully reviewed with step-by-step instructions, preparation times, and ingredient lists.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-users"></i></div>
                    <h3>Community Driven</h3>
                    <p>Share your own culinary creations, publish family secrets, and connect with fellow foodies globally.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <h3>Instant Search & Filter</h3>
                    <p>Quickly find exact meals by category, preparation time, or ingredients using our real-time search engine.</p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="stats-banner">
        <div class="container">
            <div class="stats-grid">
                <div>
                    <span class="stat-num">500+</span>
                    <span class="stat-label">Delicious Recipes</span>
                </div>
                <div>
                    <span class="stat-num">50k+</span>
                    <span class="stat-label">Active Foodies</span>
                </div>
                <div>
                    <span class="stat-num">100+</span>
                    <span class="stat-label">Global Cuisines</span>
                </div>
                <div>
                    <span class="stat-num">4.9â˜…</span>
                    <span class="stat-label">Average User Rating</span>
                </div>
            </div>
        </div>
    </section>

    
    <footer class="footer">
        <div class="container footer-flex">
            <div>&copy; 2026 Digital Recipe Book. All rights reserved.</div>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <script src="app.js"></script>
</body>
</html>
SESSION['username'] ?? 'Profile'); ?></span>
                    </a>
                    <a href="auth/logout.php" class="login-btn" style="background:#ef4444; padding: 8px 16px; border-radius: 99px; color: white; font-weight: 600;">Logout</a>
                <?php else: ?>
                    <a href="auth/login.php" class="login-btn" id="loginBtn">
                        <i class="fa-regular fa-user"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    
    <section class="about-hero">
        <div class="container">
            <h1 class="about-hero-title">About <span>Digital Recipe Book</span></h1>
            <p class="about-hero-sub">Empowering food lovers, home cooks, and professional chefs to discover, cook, and share authentic culinary recipes across the globe.</p>
        </div>
    </section>

    
    <section class="story-section">
        <div class="container">
            <div class="story-grid">
                <div class="story-content">
                    <h2>Our Culinary Mission</h2>
                    <p>Cooking is an art that connects families, traditions, and diverse cultures. Digital Recipe Book was created as an interactive, centralized platform designed to eliminate the frustration of scattered, hard-to-follow internet recipes.</p>
                    <p>Whether you are a beginner looking for quick 15-minute breakfast ideas or an experienced chef experimenting with international cuisines, our platform provides step-by-step guides, precise ingredient measurements, and community-shared cooking secrets.</p>
                </div>
                <div class="story-img-wrap">
                    <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=1000&auto=format&fit=crop" 
                         onerror="this.src='assets/images/hero_pasta_dish.jpg';" 
                         alt="Cooking Together in Kitchen">
                </div>
            </div>
        </div>
    </section>

    
    <section class="values-section">
        <div class="container">
            <div class="section-center-head">
                <h2>Why Choose Digital Recipe Book?</h2>
                <p style="color: #64748b;">Built with modern web standards and designed for food enthusiasts everywhere.</p>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-utensils"></i></div>
                    <h3>Curated Recipes</h3>
                    <p>Every dish is carefully reviewed with step-by-step instructions, preparation times, and ingredient lists.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-users"></i></div>
                    <h3>Community Driven</h3>
                    <p>Share your own culinary creations, publish family secrets, and connect with fellow foodies globally.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <h3>Instant Search & Filter</h3>
                    <p>Quickly find exact meals by category, preparation time, or ingredients using our real-time search engine.</p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="stats-banner">
        <div class="container">
            <div class="stats-grid">
                <div>
                    <span class="stat-num">500+</span>
                    <span class="stat-label">Delicious Recipes</span>
                </div>
                <div>
                    <span class="stat-num">50k+</span>
                    <span class="stat-label">Active Foodies</span>
                </div>
                <div>
                    <span class="stat-num">100+</span>
                    <span class="stat-label">Global Cuisines</span>
                </div>
                <div>
                    <span class="stat-num">4.9â˜…</span>
                    <span class="stat-label">Average User Rating</span>
                </div>
            </div>
        </div>
    </section>

    
    <footer class="footer">
        <div class="container footer-flex">
            <div>&copy; 2026 Digital Recipe Book. All rights reserved.</div>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <script src="app.js"></script>
</body>
</html>
