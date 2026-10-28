<?php
/**
 * The standalone blog has been merged into the main site.
 * Travel guides now live at /guides — redirect everything there.
 */
$base = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/\\');
$target = $base . '/guides';

// Preserve single-post slugs: /blog/{slug} -> /guides/{slug}
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);
$pos = array_search('blog', $parts, true);
if ($pos !== false && isset($parts[$pos + 1])) {
    $target .= '/' . $parts[$pos + 1];
}

header('Location: ' . $target, true, 301);
exit;
