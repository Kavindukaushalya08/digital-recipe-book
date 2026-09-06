<?php
/**
 * Global Helper Functions & Security Utilities
 * Course: ICT 1209 - Web Technologies
 */

// Start PHP Session cleanly if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Sanitize User Input against XSS (Cross-Site Scripting)
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Check if User is Logged In
 */
function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Require Login Redirect Guard
 */
function require_login() {
    if (!is_logged_in()) {
        header("Location: auth/login.php");
        exit();
    }
}

/**
 * Get Logged-In User Information
 */
function get_logged_in_user() {
    if (is_logged_in()) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'] ?? 'User',
            'email' => $_SESSION['email'] ?? ''
        ];
    }
    return null;
}
?>
