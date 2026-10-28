<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Single Post</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <main class="container">
        <article class="single-post">
            <h1><?php echo escape($post['title']); ?></h1>
            <p class="meta">Published on <?php echo format_date($post['published_at']); ?> by <?php echo escape($post['author']); ?></p>
            
            <?php if (!empty($post['featured_image'])): ?>
                <img src="../assets/images/<?php echo escape($post['featured_image']); ?>" alt="<?php echo escape($post['title']); ?>">
            <?php endif; ?>
            
            <div class="content">
                <?php echo wpautop($post['content']); ?>
            </div>
            
            <?php if (!empty($post['tags'])): ?>
                <div class="tags">
                    <strong>Tags:</strong>
                    <?php 
                    $tags = explode(',', $post['tags']);
                    foreach ($tags as $tag): 
                        $tag = trim($tag);
                        if ($tag):
                    ?>
                        <a href="index.php/blog?tag=<?php echo escape($tag); ?>"><?php echo escape($tag); ?></a>
                    <?php endif; endforeach; ?>
                </div>
            <?php endif; ?>
        </article>
    </main>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>