<?php
/**
 * Database Operations
 */

/**
 * Create database tables
 */
function create_tables() {
    $db = get_db();
    
    $sql = "CREATE TABLE IF NOT EXISTS blog_posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        excerpt TEXT,
        content LONGTEXT,
        author VARCHAR(100),
        status ENUM('draft', 'published', 'private') DEFAULT 'published',
        published_at DATETIME,
        updated_at DATETIME,
        category VARCHAR(100),
        tags VARCHAR(255),
        featured_image VARCHAR(255),
        view_count INT DEFAULT 0,
        seo_title VARCHAR(255),
        seo_description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $db->exec($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS blog_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(100) UNIQUE NOT NULL,
        description TEXT,
        parent_id INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $db->exec($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS blog_comments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        post_id INT,
        author VARCHAR(100) NOT NULL,
        author_email VARCHAR(255),
        content TEXT NOT NULL,
        status ENUM('pending', 'approved', 'spam') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $db->exec($sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS blog_settings (
        `key` VARCHAR(100) PRIMARY KEY,
        `value` TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $db->exec($sql);
}

/**
 * Insert a new post
 */
function insert_post($post) {
    $db = get_db();
    
    $sql = "INSERT INTO blog_posts 
        (title, slug, excerpt, content, author, status, published_at, updated_at, 
         category, tags, featured_image, seo_title, seo_description) 
        VALUES 
        (:title, :slug, :excerpt, :content, :author, :status, :published_at, :updated_at,
         :category, :tags, :featured_image, :seo_title, :seo_description)";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':title' => $post['title'],
        ':slug' => $post['slug'],
        ':excerpt' => $post['excerpt'] ?? '',
        ':content' => $post['content'],
        ':author' => $post['author'] ?? 'Admin',
        ':status' => $post['status'] ?? 'published',
        ':published_at' => $post['published_at'] ?? date('Y-m-d H:i:s'),
        ':updated_at' => date('Y-m-d H:i:s'),
        ':category' => $post['category'] ?? '',
        ':tags' => $post['tags'] ?? '',
        ':featured_image' => $post['featured_image'] ?? '',
        ':seo_title' => $post['seo_title'] ?? '',
        ':seo_description' => $post['seo_description'] ?? ''
    ]);
    
    return $db->lastInsertId();
}

/**
 * Update existing post
 */
function update_post($id, $post) {
    $db = get_db();
    
    $sql = "UPDATE blog_posts SET 
        title = :title, slug = :slug, excerpt = :excerpt, content = :content, 
        author = :author, status = :status, published_at = :published_at, updated_at = :updated_at,
        category = :category, tags = :tags, featured_image = :featured_image,
        seo_title = :seo_title, seo_description = :seo_description
        WHERE id = :id";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':title' => $post['title'],
        ':slug' => $post['slug'],
        ':excerpt' => $post['excerpt'] ?? '',
        ':content' => $post['content'],
        ':author' => $post['author'] ?? 'Admin',
        ':status' => $post['status'] ?? 'published',
        ':published_at' => $post['published_at'] ?? date('Y-m-d H:i:s'),
        ':updated_at' => date('Y-m-d H:i:s'),
        ':category' => $post['category'] ?? '',
        ':tags' => $post['tags'] ?? '',
        ':featured_image' => $post['featured_image'] ?? '',
        ':seo_title' => $post['seo_title'] ?? '',
        ':seo_description' => $post['seo_description'] ?? ''
    ]);
    
    return $stmt->rowCount();
}

/**
 * Delete a post
 */
function delete_post($id) {
    $db = get_db();
    $stmt = $db->prepare("DELETE FROM blog_posts WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

/**
 * Increment view count
 */
function increment_view_count($id) {
    $db = get_db();
    $stmt = $db->prepare("UPDATE blog_posts SET view_count = view_count + 1 WHERE id = :id");
    $stmt->execute([':id' => $id]);
}