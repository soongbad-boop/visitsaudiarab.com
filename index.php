<?php
/**
 * VisitSaudiArab — Front Controller
 * All requests are routed through this file (see .htaccess).
 */

// Allow `php -S localhost:8000 index.php` to serve real files (CSS/JS/images)
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($path !== '/' && is_file(__DIR__ . $path)) {
        return false;
    }
}

require_once __DIR__ . '/config.php';

// Seed JSON data files on first run
vsa_seed_if_empty();

// ---- Routing ---------------------------------------------------------------
$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = BASE_URL;

$path = $uri;
if ($base !== '' && strpos($path, $base) === 0) {
    $path = substr($path, strlen($base));
}
$path = trim($path, '/');
// Strip a leading index.php when using PATH_INFO style URLs
$path = preg_replace('#^index\.php/?#', '', $path);
$path = trim($path, '/');

$segments = $path === '' ? [] : explode('/', $path);
$page = $segments[0] ?? '';
$slug = $segments[1] ?? '';

$routes = [
    ''            => 'home.php',
    'home'        => 'home.php',
    'destinations'=> 'destinations.php',
    'attractions' => 'attractions.php',
    'events'      => 'events.php',
    'guides'      => 'guides.php',
    'about'       => 'about.php',
    'contact'     => 'contact.php',
    'search'      => 'search.php',
];

$file = null;

if (isset($routes[$page])) {
    $file = $routes[$page];
    // Detail pages: /destinations/{slug}, /attractions/{slug}, /events/{slug}, /guides/{slug}
    if ($slug !== '' && in_array($page, ['destinations', 'attractions', 'events', 'guides'], true)) {
        $type  = $page === 'guides' ? 'posts' : $page;
        $item  = vsa_find($type, $slug);
        if ($item) {
            $file = rtrim($page, 's') . '.php';   // destination.php, attraction.php, event.php, guide.php
            if ($page === 'guides') $file = 'guide.php';
        } else {
            $file = '404.php';
        }
    }
} else {
    $file = '404.php';
}

require ROOT_PATH . '/pages/' . $file;
