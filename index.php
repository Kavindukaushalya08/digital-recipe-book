<?php



if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] !== '') {
    $clean_url = str_replace($_SERVER['PATH_INFO'], '', $_SERVER['REQUEST_URI']);
    header("Location: " . $clean_url);
    exit;
}

require_once 'includes/db.php';
require_once 'includes/functions.php';


$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';


$recipes = [];
try {
    $stmt = $pdo->query("SELECT * FROM recipes ORDER BY id ASC LIMIT 5");
    $recipes = $stmt->fetchAll();
} catch (Exception $e) {

    $recipes = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Recipe Book - Discover, Cook & Share Recipes</title>
    <base href="<?php echo htmlspecialchars($base_path, ENT_QUOTES, 'UTF-8'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .modal-overlay { position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); z-index: 99999; display: none; align-items: flex-start; justify-content: center; padding: 70px 20px 30px; }
        .modal-overlay.active { display: flex; }
        .search-modal-container { background: #ffffff; width: 100%; max-width: 680px; border-radius: 20px; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.35); overflow: hidden; display: flex; flex-direction: column; max-height: 80vh; }
        .search-modal-header { display: flex; align-items: center; padding: 18px 24px; border-bottom: 1px solid #f1f5f9; gap: 14px; background: #ffffff; }
        .search-modal-icon { font-size: 1.3rem; color: #00a843; }
        .search-modal-input { flex: 1; border: none; outline: none; font-size: 1.15rem; font-family: inherit; font-weight: 600; color: #1e252b; background: transparent; }
        .search-modal-close-btn { background: #f1f5f9; color: #64748b; border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-size: 1rem; cursor: pointer; }
        .search-modal-close-btn:hover { background: #fee2e2; color: #ef4444; }
        .search-modal-categories { display: flex; gap: 8px; padding: 12px 24px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; overflow-x: auto; white-space: nowrap; }
        .search-tag-chip { padding: 5px 14px; border-radius: 999px; font-size: 0.82rem; font-weight: 600; background: #ffffff; color: #475569; border: 1px solid #cbd5e1; cursor: pointer; }
        .search-tag-chip:hover, .search-tag-chip.active { background: #00a843; color: white; border-color: #00a843; }
        .search-modal-results { padding: 12px 16px; overflow-y: auto; max-height: 480px; display: flex; flex-direction: column; gap: 8px; }
        .search-result-item { display: flex; align-items: center; gap: 16px; padding: 10px 14px; border-radius: 12px; background: #ffffff; border: 1px solid transparent; cursor: pointer; transition: all 0.2s; }
        .search-result-item:hover { background: #f0fdf4; border-color: #bbf7d0; transform: translateX(4px); }
        .search-result-thumb { width: 54px; height: 54px; border-radius: 10px; object-fit: cover; flex-shrink: 0; }
        .search-result-info { flex: 1; min-width: 0; }
        .search-result-title { font-weight: 700; font-size: 1rem; color: #1e252b; margin-bottom: 2px; }
        .search-result-meta { font-size: 0.82rem; color: #64748b; display: flex; align-items: center; gap: 10px; }
        .search-result-badge { background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; }
        .search-modal-footer { padding: 10px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; font-size: 0.8rem; color: #94a3b8; }
        .recipe-detail-modal { background: #ffffff; border-radius: 24px; width: 100%; max-width: 600px; max-height: 85vh; overflow-y: auto; position: relative; }
        .modal-close { position: absolute; top: 16px; right: 16px; width: 36px; height: 36px; background: rgba(0,0,0,0.5); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; cursor: pointer; border: none; }
        .recipe-detail-img { width: 100%; height: 260px; object-fit: cover; }
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

            <nav class="nav-links" id="navLinks">
                <a href="index.php" class="nav-link active">Home</a>
                <a href="recipes.php" class="nav-link">Recipes</a>
                <a href="about.html" class="nav-link">About</a>
                <a href="contact.php" class="nav-link">Contact</a>
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
                    <a href="auth/login.php" class="login-btn" id="loginBtn">
                        <i class="fa-regular fa-user"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    
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
                    <a href="recipes.php" class="btn btn-primary" id="browseRecipesBtn">
                        <i class="fa-solid fa-border-all"></i>
                        <span>Browse Recipes</span>
                    </a>
                    <a href="add-recipe.html" class="btn btn-outline" id="addRecipeBtn">
                        <i class="fa-solid fa-plus"></i>
                        <span>Add Your Recipe</span>
                    </a>
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

    
    <section class="popular-recipes-section" id="recipes">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><i class="fa-solid fa-fire text-orange"></i> Popular Recipes</h2>
                <div class="category-filters" id="categoryFilters">
                    <button class="filter-chip active" data-category="all">All</button>
                    <button class="filter-chip" data-category="Breakfast">Breakfast</button>
                    <button class="filter-chip" data-category="Lunch">Lunch</button>
                    <button class="filter-chip" data-category="Dinner">Dinner</button>
                    <button class="filter-chip" data-category="Dessert">Dessert</button>
                    <button class="filter-chip" data-category="Snacks">Snacks</button>
                </div>
            </div>

            
            <div class="recipes-grid" id="recipesGrid">
                
            </div>
        </div>
    </section>

    
    <section class="about-section" id="about">
        <div class="container about-container">
            <h2>Join Our Culinary Community</h2>
            <p>Digital Recipe Book brings together food lovers, home cooks, and professional chefs to share authentic flavors, easy-to-follow guides, and culinary secrets from across the globe.</p>
            <div class="stats-row">
                <div class="stat-item"><span class="stat-num">500+</span><span class="stat-label">Recipes</span></div>
                <div class="stat-item"><span class="stat-num">50k+</span><span class="stat-label">Foodies</span></div>
                <div class="stat-item"><span class="stat-num">4.9 <i class="fa-solid fa-star" style="color: #ffb800; font-size: 1.2rem;"></i></span><span class="stat-label">Rating</span></div>
            </div>
        </div>
    </section>

    
        <footer class="footer" id="contact">
        <div class="container footer-flex">
            <div>&copy; 2026 Digital Recipe Book. All rights reserved.</div>
            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    
    <div class="modal-overlay" id="recipeModal">
        <div class="modal-content recipe-detail-modal">
            <button class="modal-close" id="closeRecipeModal">&times;</button>
            <div class="recipe-detail-body" id="recipeDetailBody"></div>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>


