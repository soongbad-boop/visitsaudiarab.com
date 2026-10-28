<?php
/** @var array $item Destination passed from the router. */
$meta_title = $item['name'] . ' Travel Guide — ' . SITE_NAME;
$meta_desc  = $item['tagline'];
require ROOT_PATH . '/includes/header.php';

$attractions = vsa_where('attractions', 'destination', $item['slug']);
?>
<section class="vsa-banner <?php echo e($item['gradient'] ?? 'g1'); ?>">
    <div class="vsa-container">
        <span><?php echo e($item['emoji'] ?? '📍'); ?></span>
        <h1><?php echo e($item['name']); ?></h1>
        <p><?php echo e($item['tagline']); ?></p>
    </div>
</section>

<div class="vsa-container">
    <nav class="vsa-breadcrumbs">
        <a href="<?php echo e(url()); ?>">Home</a> ›
        <a href="<?php echo e(url('destinations')); ?>">Destinations</a> ›
        <?php echo e($item['name']); ?>
    </nav>

    <div class="vsa-kbyg">
        <h2>Know before you go</h2>
        <dl>
            <dt>Region</dt><dd><?php echo e($item['region']); ?></dd>
            <dt>Best time to visit</dt><dd><?php echo e($item['best_time']); ?></dd>
        </dl>
    </div>

    <div class="vsa-content">
        <?php echo paragraphs($item['description']); ?>
    </div>

    <?php if (!empty($item['highlights'])): ?>
        <section class="vsa-section">
            <h2>Top things to do in <?php echo e($item['name']); ?></h2>
            <ul class="vsa-highlights">
                <?php foreach ($item['highlights'] as $h): ?><li><?php echo e($h); ?></li><?php endforeach; ?>
            </ul>
        </section>
    <?php endif; ?>

    <?php if ($attractions): ?>
        <section class="vsa-section">
            <h2>Attractions in <?php echo e($item['name']); ?></h2>
            <div class="vsa-grid">
                <?php foreach ($attractions as $a) render_card('attractions', $a); ?>
            </div>
        </section>
    <?php endif; ?>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
