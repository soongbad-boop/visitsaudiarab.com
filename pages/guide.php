<?php
/** @var array $item Guide/post passed from the router. */
$meta_title = $item['title'] . ' — ' . SITE_NAME;
$meta_desc  = $item['excerpt'];
require ROOT_PATH . '/includes/header.php';

$related = array_filter(vsa_all('posts'), fn($p) => $p['slug'] !== $item['slug'] && $p['category'] === $item['category']);
?>
<div class="vsa-container">
    <nav class="vsa-breadcrumbs">
        <a href="<?php echo e(url()); ?>">Home</a> ›
        <a href="<?php echo e(url('guides')); ?>">Guides</a> ›
        <?php echo e($item['title']); ?>
    </nav>

    <article class="vsa-section vsa-content" style="max-width:760px;">
        <span class="vsa-badge"><?php echo e($item['category']); ?></span>
        <h1 style="margin:10px 0 4px;"><?php echo e($item['emoji'] ?? ''); ?> <?php echo e($item['title']); ?></h1>
        <p class="vsa-article-meta">
            By <?php echo e($item['author']); ?> · <?php echo e(format_date($item['published_at'])); ?> ·
            <?php echo reading_time($item['content']); ?> min read
        </p>

        <?php echo paragraphs($item['content']); ?>

        <?php if (!empty($item['tags'])): ?>
            <div class="vsa-tags">
                <?php foreach ($item['tags'] as $tag): ?>
                    <a href="<?php echo e(url('search?q=' . urlencode($tag))); ?>">#<?php echo e($tag); ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </article>

    <?php if ($related): ?>
        <section class="vsa-section">
            <h2>Related guides</h2>
            <div class="vsa-grid">
                <?php foreach (array_slice($related, 0, 3) as $g) render_card('posts', $g); ?>
            </div>
        </section>
    <?php endif; ?>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
