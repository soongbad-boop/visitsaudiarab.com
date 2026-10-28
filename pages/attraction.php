<?php
/** @var array $item Attraction passed from the router. */
$destination = vsa_find('destinations', $item['destination'] ?? '');
$meta_title = $item['name'] . ' — ' . SITE_NAME;
$meta_desc  = truncate($item['description'], 155);
require ROOT_PATH . '/includes/header.php';
?>
<section class="vsa-banner <?php echo e($item['gradient'] ?? 'g1'); ?>">
    <div class="vsa-container">
        <span><?php echo e($item['emoji'] ?? '📍'); ?></span>
        <h1><?php echo e($item['name']); ?></h1>
        <p><?php echo e($item['category'] ?? 'Attraction'); ?><?php echo $destination ? ' · ' . e($destination['name']) : ''; ?></p>
    </div>
</section>

<div class="vsa-container">
    <nav class="vsa-breadcrumbs">
        <a href="<?php echo e(url()); ?>">Home</a> ›
        <a href="<?php echo e(url('attractions')); ?>">Attractions</a> ›
        <?php echo e($item['name']); ?>
    </nav>

    <div class="vsa-kbyg">
        <h2>Visitor information</h2>
        <dl>
            <?php if ($destination): ?>
                <dt>Destination</dt>
                <dd><a href="<?php echo e(url('destinations/' . $destination['slug'])); ?>"><?php echo e($destination['name']); ?></a></dd>
            <?php endif; ?>
            <dt>Category</dt><dd><?php echo e($item['category'] ?? '—'); ?></dd>
            <dt>Tickets</dt><dd><?php echo e($item['ticket'] ?? '—'); ?></dd>
            <dt>Hours</dt><dd><?php echo e($item['hours'] ?? '—'); ?></dd>
        </dl>
    </div>

    <div class="vsa-content">
        <?php echo paragraphs($item['description']); ?>
    </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
