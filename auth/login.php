<?php



require_once '../includes/db.php';
require_once '../includes/functions.php';

$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $loginInput = trim($_POST['username']);
    $password   = trim($_POST['password']);

    if (empty($loginInput) || empty($password)) {
        $error = "Please enter both Username/Email and Password!";
    } else {

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$loginInput, $loginInput]);
        $user = $stmt->fetch();


        if ($user && password_verify($password, $user['password'])) {
            

            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email']    = $user['email'];
            
            session_regenerate_id(true); 


            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Invalid Username/Email or Password!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Digital Recipe Book</title>
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
        .alert { padding: 12px; border-radius: 8px; font-size: 0.9rem; margin-bottom: 16px; text-align: center; background: #fee2e2; color: #991b1b; }
        .text-center { text-align: center; margin-top: 16px; font-size: 0.9rem; color: #64748b; }
        .text-center a { color: #00a843; font-weight: 700; text-decoration: none; }
    </style>
</head>
<body>

    <div class="auth-card">
        <h2 class="auth-title">Welcome Back!</h2>

        <?php if (!empty($error)): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Username or Email</label>
                <input type="text" name="username" required placeholder="Enter username or email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter password">
            </div>
            <button type="submit" class="btn-submit">Sign In</button>
        </form>

        <div class="text-center">
            Don't have an account? <a href="register.php">Create Account</a>
        </div>
    </div>

</body>
</html>
