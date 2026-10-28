<?php
$q = trim($_GET['q'] ?? '');
$meta_title = ($q !== '' ? 'Search: ' . $q . ' — ' : 'Search — ') . SITE_NAME;
require ROOT_PATH . '/includes/header.php';

$results = vsa_search_all($q);
$total   = array_sum(array_map('count', $results));
$labels  = ['destinations' => 'Destinations', 'attractions' => 'Attractions', 'events' => 'Events', 'posts' => 'Guides'];
?>
<section class="vsa-section vsa-container">
    <h1>Search</h1>
    <form class="vsa-search" role="search" method="get" action="<?php echo e(url('search')); ?>" style="margin:18px 0 30px;">
        <input type="search" name="q" value="<?php echo e($q); ?>" placeholder="Search destinations, attractions, guides…" aria-label="Search">
        <button type="submit">Search</button>
    </form>

    <?php if ($q !== ''): ?>
        <p class="vsa-sub"><?php echo $total; ?> result<?php echo $total === 1 ? '' : 's'; ?> for “<?php echo e($q); ?>”</p>
        <?php foreach ($results as $type => $rows): if (!$rows) continue; ?>
            <h2><?php echo e($labels[$type]); ?></h2>
            <div class="vsa-grid">
                <?php foreach ($rows as $row) render_card($type, $row); ?>
            </div>
        <?php endforeach; ?>
        <?php if ($total === 0): ?>
            <p>No matches — try “Riyadh”, “visa”, “beach” or “festival”.</p>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
