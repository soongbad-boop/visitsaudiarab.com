<?php
/** @var array $item Event passed from the router. */
$meta_title = $item['name'] . ' — ' . SITE_NAME;
$meta_desc  = truncate($item['description'], 155);
require ROOT_PATH . '/includes/header.php';
?>
<section class="vsa-banner <?php echo e($item['gradient'] ?? 'g1'); ?>">
    <div class="vsa-container">
        <span><?php echo e($item['emoji'] ?? '🎉'); ?></span>
        <h1><?php echo e($item['name']); ?></h1>
        <p><?php echo e($item['city']); ?> · <?php echo e($item['dates']); ?></p>
    </div>
</section>

<div class="vsa-container">
    <nav class="vsa-breadcrumbs">
        <a href="<?php echo e(url()); ?>">Home</a> ›
        <a href="<?php echo e(url('events')); ?>">Events</a> ›
        <?php echo e($item['name']); ?>
    </nav>

    <div class="vsa-kbyg">
        <h2>Event information</h2>
        <dl>
            <dt>City</dt><dd><?php echo e($item['city']); ?></dd>
            <dt>When</dt><dd><?php echo e($item['dates']); ?></dd>
            <dt>Frequency</dt><dd><?php echo e($item['status'] ?? 'Annual'); ?></dd>
        </dl>
    </div>

    <div class="vsa-content">
        <?php echo paragraphs($item['description']); ?>
    </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
