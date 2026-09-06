<?php

require_once 'includes/db.php';
require_once 'includes/functions.php';

require_login();

$user = get_logged_in_user();
$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title        = sanitize_input($_POST['title'] ?? '');
    $category     = sanitize_input($_POST['category'] ?? 'Main Course');
    $prep_time    = sanitize_input($_POST['prep_time'] ?? '20 mins');
    $ingredients  = sanitize_input($_POST['ingredients'] ?? '');
    $instructions = sanitize_input($_POST['instructions'] ?? '');
    $user_id      = $user['id'];

    if (empty($title) || empty($ingredients) || empty($instructions)) {
        $err = "Please fill in all required recipe fields!";
    } else {

        $stmt = $pdo->prepare("INSERT INTO recipes (title, category, prep_time, ingredients, instructions, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $category, $prep_time, $ingredients, $instructions, $user_id])) {
            $msg = "Recipe '$title' published successfully!";
        } else {
            $err = "Failed to publish recipe. Please try again.";
        }
    }
}

$userRecipesStmt = $pdo->prepare("SELECT * FROM recipes WHERE user_id = ? ORDER BY id DESC");
$userRecipesStmt->execute([$user['id']]);
$myRecipes = $userRecipesStmt->fetchAll();
$base_path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - Digital Recipe Book</title>
    <base href="<?php echo htmlspecialchars($base_path, ENT_QUOTES, 'UTF-8'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .dashboard-container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
        .dashboard-header { background: #ffffff; padding: 28px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); margin-bottom: 30px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
        .user-greeting h1 { font-family: 'Outfit', sans-serif; font-size: 1.8rem; color: #1e252b; }
        .user-greeting p { color: #64748b; font-size: 0.95rem; }
        .dashboard-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }
        .dash-card { background: #ffffff; padding: 30px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        .dash-card-title { font-family: 'Outfit', sans-serif; font-size: 1.3rem; font-weight: 700; margin-bottom: 20px; color: #257838; display: flex; align-items: center; gap: 8px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-weight: 700; font-size: 0.85rem; margin-bottom: 6px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-family: inherit; font-size: 0.92rem; box-sizing: border-box; }
        .btn-green { background: #00a843; color: white; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 700; cursor: pointer; width: 100%; font-size: 1rem; }
        .btn-green:hover { background: #008f39; }
        .my-recipe-item { padding: 14px; background: #f8fafc; border-radius: 12px; margin-bottom: 12px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        .my-recipe-item h4 { font-size: 1rem; color: #1e252b; margin-bottom: 4px; }
        .my-recipe-item span { font-size: 0.82rem; color: #64748b; font-weight: 600; }
        .alert { padding: 12px; border-radius: 8px; font-size: 0.9rem; margin-bottom: 16px; text-align: center; }
        .alert-success { background: #dcfce7; color: #166534; }
        .alert-danger { background: #fee2e2; color: #991b1b; }
        @media(max-width: 768px) { .dashboard-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body style="background-color: #f1f5f9;">

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
                <a href="contact.php" class="nav-link">Contact</a>
            </nav>
            <div class="nav-actions">
                <button class="search-trigger-btn" id="searchTriggerBtn" title="Search Recipes (Ctrl+K)" style="background:none; border:none; font-size:1.2rem; cursor:pointer; color:#1e252b; padding:8px;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <a href="auth/logout.php" class="login-btn" style="background:#ef4444;"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
            </div>
        </div>
    </header>

    <div class="dashboard-container">

        <div class="dashboard-header">
            <div class="user-greeting">
                <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>! ðŸ‘‹</h1>
                <p>Manage your submitted recipes and share new culinary dishes.</p>
            </div>
            <div>
                <a href="index.php" class="btn btn-outline" style="border:2px solid #257838; color:#257838; padding:8px 18px; border-radius:10px; font-weight:700;">View Live Site</a>
            </div>
        </div>

        <?php if (!empty($msg)): ?>
            <div class="alert alert-success"><?php echo $msg; ?></div>
        <?php endif; ?>
        <?php if (!empty($err)): ?>
            <div class="alert alert-danger"><?php echo $err; ?></div>
        <?php endif; ?>

        <div class="dashboard-grid">

            <div class="dash-card">
                <h3 class="dash-card-title"><i class="fa-solid fa-plus-circle"></i> Add New Recipe</h3>
                <form action="dashboard.php" method="POST">
                    <div class="form-group">
                        <label>Recipe Title</label>
                        <input type="text" name="title" required placeholder="e.g. Garlic Butter Shrimp">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" required>
                            <option value="Breakfast">Breakfast</option>
                            <option value="Lunch" selected>Lunch</option>
                            <option value="Dinner">Dinner</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Drinks">Drinks</option>
                            <option value="Snacks">Snacks</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Preparation Time</label>
                        <input type="text" name="prep_time" placeholder="e.g. 25 mins" required>
                    </div>
                    <div class="form-group">
                        <label>Ingredients (comma separated)</label>
                        <textarea name="ingredients" rows="3" required placeholder="Shrimp, butter, garlic, lemon juice, parsley"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Cooking Instructions</label>
                        <textarea name="instructions" rows="4" required placeholder="Melt butter, sautÃ© garlic, cook shrimp for 4 minutes and garnish."></textarea>
                    </div>
                    <button type="submit" class="btn-green"><i class="fa-solid fa-upload me-2"></i> Publish to Database</button>
                </form>
            </div>

            <div class="dash-card">
                <h3 class="dash-card-title"><i class="fa-solid fa-book-open"></i> My Submitted Recipes (<?php echo count($myRecipes); ?>)</h3>
                
                <?php if (empty($myRecipes)): ?>
                    <p style="color: #64748b; text-align: center; padding: 40px 0;">You haven't submitted any recipes yet. Use the form to publish your first recipe!</p>
                <?php else: ?>
                    <?php foreach ($myRecipes as $recipe): ?>
                        <div class="my-recipe-item">
                            <div>
                                <h4><?php echo htmlspecialchars($recipe['title']); ?></h4>
                                <span><?php echo htmlspecialchars($recipe['category']); ?> &bull; <?php echo htmlspecialchars($recipe['prep_time']); ?></span>
                            </div>
                            <span style="color: #257838; font-weight: 700;">Active</span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>

    </div>

    <script src="app.js"></script>
</body>
</html>

