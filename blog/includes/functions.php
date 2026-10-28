<?php
/**
 * Core Functions for Blog
 */

/**
 * Get all posts with optional filters
 */
function get_posts($filters = []) {
    $db = get_db();
    $where = [];
    $params = [];
    
    if (isset($filters['status']) && $filters['status'] === 'published') {
        $where[] = 'status = :status';
        $params[':status'] = 'published';
    }
    
    if (!empty($filters['category'])) {
        $where[] = 'category = :category';
        $params[':category'] = $filters['category'];
    }
    
    if (!empty($filters['tag'])) {
        $where[] = 'tags LIKE :tag';
        $params[':tag'] = '%' . $filters['tag'] . '%';
    }
    
    if (!empty($filters['search'])) {
        $where[] = '(title LIKE :search OR content LIKE :search OR excerpt LIKE :search)';
        $params[':search'] = '%' . $filters['search'] . '%';
    }
    
    $orderby = $filters['orderby'] ?? 'published_at';
    $order = $filters['order'] ?? 'DESC';
    $limit = $filters['limit'] ?? 10;
    $offset = $filters['offset'] ?? 0;
    
    $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
    $sql = "SELECT * FROM blog_posts $whereClause ORDER BY $orderby $order LIMIT :limit OFFSET :offset";
    
    $stmt = $db->prepare($sql);
    foreach ($params as $key => $value) {
        if (in_array($key, [':limit', ':offset'])) {
            $stmt->bindValue($key, $value, PDO::PARAM_INT);
        } else {
            $stmt->bindValue($key, $value);
        }
    }
    $stmt->execute();
    
    return $stmt->fetchAll();
}

/**
 * Get single post by slug
 */
function get_post($slug) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM blog_posts WHERE slug = :slug AND status = 'published'");
    $stmt->execute([':slug' => $slug]);
    return $stmt->fetch();
}

/**
 * Get post by ID
 */
function get_post_by_id($id) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM blog_posts WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

/**
 * Get categories
 */
function get_categories() {
    $db = get_db();
    $stmt = $db->query("SELECT * FROM blog_categories ORDER BY name ASC");
    return $stmt->fetchAll();
}

/**
 * Get category by slug
 */
function get_category($slug) {
    $db = get_db();
    $stmt = $db->prepare("SELECT * FROM blog_categories WHERE slug = :slug");
    $stmt->execute([':slug' => $slug]);
    return $stmt->fetch();
}

/**
 * Get posts count
 */
function get_posts_count($filters = []) {
    $db = get_db();
    $where = [];
    $params = [];
    
    if (isset($filters['status']) && $filters['status'] === 'published') {
        $where[] = 'status = :status';
        $params[':status'] = 'published';
    }
    
    if (!empty($filters['category'])) {
        $where[] = 'category = :category';
        $params[':category'] = $filters['category'];
    }
    
    if (!empty($filters['search'])) {
        $where[] = '(title LIKE :search OR content LIKE :search OR excerpt LIKE :search)';
        $params[':search'] = '%' . $filters['search'] . '%';
    }
    
    $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
    $sql = "SELECT COUNT(*) FROM blog_posts $whereClause";
    
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    
    return $stmt->fetchColumn();
}

/**
 * Generate slug from title
 */
function generate_slug($title) {
    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

/**
 * Format date
 */
function format_date($date, $format = 'F j, Y') {
    if (!$date) return '';
    return date($format, strtotime($date));
}

/**
 * Truncate text
 */
function truncate($text, $length = 150) {
    $text = strip_tags($text);
    if (strlen($text) <= $length) return $text;
    return substr($text, 0, $length) . '...';
}

/**
 * Get featured image URL
 */
function get_featured_image($post) {
    if (!empty($post['featured_image'])) {
        return ASSETS_PATH . '/images/' . $post['featured_image'];
    }
    return ASSETS_PATH . '/images/default-post.jpg';
}