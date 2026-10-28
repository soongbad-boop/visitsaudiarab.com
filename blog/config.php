<?php
/**
 * Blog Configuration
 * Standalone PHP Blog for VisitSaudiArab.com
 */

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'visitsaudiarab_blog');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// Site configuration
define('SITE_URL', 'http://localhost/VisitSaudiArab/blog');
define('SITE_NAME', 'VisitSaudiArab Blog');
define('SITE_TAGLINE', 'Travel Guides, Destinations & Experiences in Saudi Arabia');

// Paths
define('BLOG_PATH', __DIR__);
define('DATA_PATH', BLOG_PATH . '/data');
define('ASSETS_PATH', BLOG_PATH . '/assets');

// Database connection
function get_db() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    return $pdo;
}

// JSON backup functions
function save_json_backup($table, $data) {
    $file = DATA_PATH . '/' . $table . '.json';
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function load_json_backup($table) {
    $file = DATA_PATH . '/' . $table . '.json';
    if (file_exists($file)) {
        return json_decode(file_get_contents($file), true);
    }
    return [];
}

// Utility functions
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function is_page($page) {
    return isset($_GET['page']) && $_GET['page'] === $page;
}

function current_page() {
    return isset($_GET['page']) ? $_GET['page'] : 'home';
}

// Include other files
require_once BLOG_PATH . '/includes/functions.php';
require_once BLOG_PATH . '/includes/database.php';
require_once BLOG_PATH . '/includes/routing.php';