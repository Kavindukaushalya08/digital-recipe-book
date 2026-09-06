<?php
/* ==========================================================================
   DIGITAL RECIPE BOOK - HOME PAGE (index.php)
   Dynamic PHP & MySQL Database Integration
   ========================================================================== */

require_once 'includes/db.php';
require_once 'includes/functions.php';

// Fetch popular recipes from MySQL database
$recipes = [];
try {
    $stmt = $pdo->query("SELECT * FROM recipes ORDER BY id ASC LIMIT 5");
    $recipes = $stmt->fetchAll();
} catch (Exception $e) {
    // Fallback if table is not imported yet
    $recipes = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Recipe Book - Discover, Cook & Share Recipes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- 1. HEADER & NAVIGATION BAR -->
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

            <nav class="nav-links" id="navLinks">
                <a href="index.php" class="nav-link active">Home</a>
                <a href="recipes.html" class="nav-link">Recipes</a>
                <a href="about.html" class="nav-link">About</a>
                <a href="contact.php" class="nav-link">Contact</a>
            </nav>

            <div class="nav-actions">
                <?php if (is_logged_in()): ?>
                    <a href="dashboard.php" class="login-btn" style="background:#00a843;">Dashboard</a>
                    <a href="auth/logout.php" class="login-btn" style="background:#ef4444;">Logout</a>
                <?php else: ?>
                    <a href="auth/login.php" class="login-btn" id="loginBtn">
                        <i class="fa-regular fa-user"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- 2. HERO SECTION -->
    <section class="hero-section" id="home">
        <div class="container hero-container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Discover, Cook<br>
                    and <span class="highlight-green">Share</span><br>
                    <span class="highlight-orange">Delicious Recipes</span>
                </h1>
                <p class="hero-subtitle">
                    Explore a wide collection of recipes from around the world.
                </p>

                <div class="hero-search-box">
                    <input type="text" id="heroSearchInput" placeholder="Search for recipes...">
                    <button id="heroSearchBtn" aria-label="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>

                <div class="hero-cta-group">
                    <a href="recipes.html" class="btn btn-primary" id="browseRecipesBtn">
                        <i class="fa-solid fa-border-all"></i>
                        <span>Browse Recipes</span>
                    </a>
                    <?php if (is_logged_in()): ?>
                        <a href="dashboard.php" class="btn btn-outline" id="addRecipeBtn">
                            <i class="fa-solid fa-plus"></i>
                            <span>Add Your Recipe</span>
                        </a>
                    <?php else: ?>
                        <a href="auth/login.php" class="btn btn-outline" id="addRecipeBtn">
                            <i class="fa-solid fa-plus"></i>
                            <span>Add Your Recipe</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="hero-image-wrapper">
                <div class="hero-image-card">
                    <img src="assets/images/hero_pasta_dish.jpg" 
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1495521821757-a1efb6729352?q=80&w=1000&auto=format&fit=crop';" 
                         alt="Spaghetti Pasta" 
                         class="hero-img">
                </div>
            </div>
        </div>
    </section>

    <!-- 3. POPULAR RECIPES SECTION -->
    <section class="popular-recipes-section" id="recipes">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">🔥 Popular Recipes</h2>
                <div class="category-filters" id="categoryFilters">
                    <button class="filter-chip active" data-category="all">All</button>
                    <button class="filter-chip" data-category="Breakfast">Breakfast</button>
                    <button class="filter-chip" data-category="Lunch">Lunch</button>
                    <button class="filter-chip" data-category="Dinner">Dinner</button>
                    <button class="filter-chip" data-category="Dessert">Dessert</button>
                    <button class="filter-chip" data-category="Snacks">Snacks</button>
                </div>
            </div>

            <!-- Dynamic Recipe Grid -->
            <div class="recipes-grid" id="recipesGrid">
                <!-- If PHP recipes exist, render them or use app.js -->
            </div>
        </div>
    </section>

    <!-- 4. ABOUT SECTION -->
    <section class="about-section" id="about">
        <div class="container about-container">
            <h2>Join Our Culinary Community</h2>
            <p>Digital Recipe Book brings together food lovers, home cooks, and professional chefs to share authentic flavors, easy-to-follow guides, and culinary secrets from across the globe.</p>
            <div class="stats-row">
                <div class="stat-item"><span class="stat-num">500+</span><span class="stat-label">Recipes</span></div>
                <div class="stat-item"><span class="stat-num">50k+</span><span class="stat-label">Foodies</span></div>
                <div class="stat-item"><span class="stat-num">4.9★</span><span class="stat-label">Rating</span></div>
            </div>
        </div>
    </section>

    <!-- 5. FOOTER -->
    <footer class="footer" id="contact">
        <div class="container footer-container">
            <div class="copyright-text">&copy; 2026 Digital Recipe Book. All rights reserved.</div>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <!-- Recipe Detail Modal Popup -->
    <div class="modal-overlay" id="recipeModal">
        <div class="modal-content recipe-detail-modal">
            <button class="modal-close" id="closeRecipeModal">&times;</button>
            <div class="recipe-detail-body" id="recipeDetailBody"></div>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>
