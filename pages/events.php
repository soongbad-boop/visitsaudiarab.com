<?php
$meta_title = 'Festivals & Events — ' . SITE_NAME;
$meta_desc  = 'Riyadh Season, Winter at Tantora, Formula 1 and more — Saudi Arabia\'s annual events calendar.';
require ROOT_PATH . '/includes/header.php';
?>
<section class="vsa-section vsa-container">
    <h1>Festivals &amp; Events</h1>
    <p class="vsa-sub">Annual seasons and spectacles worth planning your trip around.</p>
    <div class="vsa-grid">
        <?php foreach (vsa_all('events') as $ev) render_card('events', $ev); ?>
    </div>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
