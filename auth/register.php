<?php
/* ==========================================================================
   USER REGISTRATION PAGE (auth/register.php)
   Simple PHP Code for Viva Examination Preparation
   ========================================================================== */

// 1. Include Database Connection
require_once '../includes/db.php';
require_once '../includes/functions.php';

$message = '';
$error = '';

// 2. Check if Form is Submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get input values from form
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Basic Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Please fill in all required fields!";
    } else {
        // Check if email already exists in database
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $username]);

        if ($stmt->rowCount() > 0) {
            $error = "Username or Email already registered!";
        } else {
            // Hash the password for security using BCRYPT
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into MySQL database
            $insertStmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($insertStmt->execute([$username, $email, $hashedPassword])) {
                $message = "Registration successful! You can now <a href='login.php'>Login here</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Digital Recipe Book</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #d1d5db; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .auth-card { background: #ffffff; padding: 40px; border-radius: 24px; width: 100%; max-width: 440px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
        .auth-title { font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; text-align: center; margin-bottom: 20px; color: #1e252b; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-weight: 700; font-size: 0.88rem; margin-bottom: 6px; }
        .form-group input { width: 100%; padding: 12px 14px; border-radius: 10px; border: 1px solid #cbd5e1; font-size: 0.95rem; box-sizing: border-box; }
        .btn-submit { width: 100%; background: #00a843; color: white; border: none; padding: 14px; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; }
        .btn-submit:hover { background: #008f39; }
        .alert { padding: 12px; border-radius: 8px; font-size: 0.9rem; margin-bottom: 16px; text-align: center; }
        .alert-danger { background: #fee2e2; color: #991b1b; }
        .alert-success { background: #dcfce7; color: #166534; }
        .text-center { text-align: center; margin-top: 16px; font-size: 0.9rem; color: #64748b; }
        .text-center a { color: #00a843; font-weight: 700; text-decoration: none; }
    </style>
</head>
<body>

    <div class="auth-card">
        <h2 class="auth-title">Create Account</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Enter username">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="Enter email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter password">
            </div>
            <button type="submit" class="btn-submit">Sign Up</button>
        </form>

        <div class="text-center">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

</body>
</html>
