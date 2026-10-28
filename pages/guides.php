<?php
$meta_title = 'Travel Guides — ' . SITE_NAME;
$meta_desc  = 'Practical guides for travelling Saudi Arabia: visas, weather, transport, food and budgets.';
require ROOT_PATH . '/includes/header.php';

$guides = vsa_all('posts');
usort($guides, fn($a, $b) => strcmp($b['published_at'], $a['published_at']));
?>
<section class="vsa-section vsa-container">
    <h1>Travel Guides</h1>
    <p class="vsa-sub">Practical, verified guides for planning your trip.</p>
    <div class="vsa-grid">
        <?php foreach ($guides as $g) render_card('posts', $g); ?>
    </div>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
