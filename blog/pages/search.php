<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Search Results</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <main class="container">
        <h1>Search Results</h1>
        
        <?php if (!empty($_GET['q'])): ?>
            <p>Results for: <?php echo escape($_GET['q']); ?></p>
            
            <div class="grid">
                <?php
                $posts = get_posts(['search' => $_GET['q'], 'limit' => 12]);
                if (empty($posts)):
                ?>
                    <p>No results found. Try a different search term.</p>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <article class="card">
                            <a href="index.php/<?php echo escape($post['slug']); ?>">
                                <?php if (!empty($post['featured_image'])): ?>
                                    <img src="../assets/images/<?php echo escape($post['featured_image']); ?>" alt="<?php echo escape($post['title']); ?>">
                                <?php endif; ?>
                                <h3><?php echo escape($post['title']); ?></h3>
                            </a>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Please enter a search term.</p>
        <?php endif; ?>
    </main>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>