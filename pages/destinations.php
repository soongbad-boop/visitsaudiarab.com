<?php
$meta_title = 'Destinations — ' . SITE_NAME;
$meta_desc  = 'Guides to Saudi Arabia\'s regions: Riyadh, Jeddah, AlUla, Diriyah, the Red Sea coast, Asir and more.';
require ROOT_PATH . '/includes/header.php';
?>
<section class="vsa-section vsa-container">
    <h1>Destinations</h1>
    <p class="vsa-sub">Every corner of the Kingdom, from desert capitals to mountain highlands.</p>
    <div class="vsa-grid">
        <?php foreach (vsa_all('destinations') as $d) render_card('destinations', $d); ?>
    </div>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
