<?php
/**
 * Routing and Page Handling
 */

// Simple routing
function route() {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = trim($path, '/');
    
    // Remove 'blog' from path if present
    $parts = explode('/', $path);
    if (in_array('blog', $parts)) {
        $blogPos = array_search('blog', $parts);
        $path = implode('/', array_slice($parts, $blogPos + 1));
    }
    
    $segments = explode('/', $path);
    $page = $segments[0] ?? 'home';
    
    switch ($page) {
        case '':
        case 'home':
            require BLOG_PATH . '/pages/home.php';
            break;
        case 'blog':
            require BLOG_PATH . '/pages/blog.php';
            break;
        case 'category':
            require BLOG_PATH . '/pages/category.php';
            break;
        case 'author':
            require BLOG_PATH . '/pages/author.php';
            break;
        case 'search':
            require BLOG_PATH . '/pages/search.php';
            break;
        case 'about':
            require BLOG_PATH . '/pages/about.php';
            break;
        case 'contact':
            require BLOG_PATH . '/pages/contact.php';
            break;
        default:
            // Check if it's a single post (slug)
            $slug = $segments[0] ?? '';
            $post = get_post($slug);
            if ($post) {
                require BLOG_PATH . '/pages/single.php';
            } else {
                require BLOG_PATH . '/pages/404.php';
            }
            break;
    }
}