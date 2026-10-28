<?php
$meta_title = 'Attractions — ' . SITE_NAME;
$meta_desc  = 'The best things to see and do in Saudi Arabia, from Hegra\'s tombs to the Edge of the World.';
require ROOT_PATH . '/includes/header.php';
?>
<section class="vsa-section vsa-container">
    <h1>Attractions</h1>
    <p class="vsa-sub">UNESCO sites, natural wonders and city landmarks across the Kingdom.</p>
    <div class="vsa-grid">
        <?php foreach (vsa_all('attractions') as $a) render_card('attractions', $a); ?>
    </div>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
