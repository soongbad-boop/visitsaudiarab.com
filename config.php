<?php
/**
 * VisitSaudiArab — Site Configuration
 * Pure PHP, JSON file storage (no database required).
 */

define('SITE_NAME', 'VisitSaudiArab');
define('SITE_TAGLINE', 'Travel Guides, Destinations & Experiences in Saudi Arabia');

define('ROOT_PATH', __DIR__);
define('DATA_PATH', ROOT_PATH . '/data');

// Auto-detect base URL (works in subfolders like /VisitSaudiArab)
$__script_dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
$__script_dir = rtrim($__script_dir, '/');
// When routed through index.php in a subfolder, SCRIPT_NAME is /VisitSaudiArab/index.php
define('BASE_URL', $__script_dir === '' ? '' : $__script_dir);

define('SITE_URL', (isset($_SERVER['HTTP_HOST'])
    ? ( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http' )
      . '://' . $_SERVER['HTTP_HOST'] . BASE_URL
    : 'http://localhost' . BASE_URL));

require_once ROOT_PATH . '/includes/functions.php';
require_once ROOT_PATH . '/includes/data.php';
