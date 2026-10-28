<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Category: <?php echo escape($category['name']); ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <main class="container">
        <h1><?php echo escape($category['name']); ?></h1>
        <?php if (!empty($category['description'])): ?>
            <p><?php echo escape($category['description']); ?></p>
        <?php endif; ?>
        
        <div class="grid">
            <?php
            $posts = get_posts(['category' => $category['slug'], 'limit' => 12]);
            foreach ($posts as $post):
            ?>
                <article class="card">
                    <a href="index.php/<?php echo escape($post['slug']); ?>">
                        <?php if (!empty($post['featured_image'])): ?>
                            <img src="../assets/images/<?php echo escape($post['featured_image']); ?>" alt="<?php echo escape($post['title']); ?>">
                        <?php endif; ?>
                        <h3><?php echo escape($post['title']); ?></h3>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </main>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>