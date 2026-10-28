<?php
$meta_title = 'About — ' . SITE_NAME;
require ROOT_PATH . '/includes/header.php';
?>
<section class="vsa-section vsa-container vsa-content">
    <h1>About <?php echo e(SITE_NAME); ?></h1>
    <p><?php echo e(SITE_TAGLINE); ?>.</p>
    <p>
        <?php echo e(SITE_NAME); ?> is an independent travel guide to the Kingdom of Saudi Arabia.
        We write practical, first-hand guides to the country's destinations, attractions,
        festivals and food — from the Nabataean tombs of Hegra to the coral reefs of the Red Sea.
    </p>
    <p>
        Every guide is checked against official sources and updated as visas, seasons and
        opening hours change. We are not affiliated with the Saudi Tourism Authority or any
        government body; recommendations are editorial and independent.
    </p>
    <h2>What we cover</h2>
    <ul class="vsa-highlights">
        <li>Destination and attraction guides</li>
        <li>Visa, transport and budgeting advice</li>
        <li>Festival and event calendars</li>
        <li>Food, culture and etiquette</li>
    </ul>
    <p><a class="vsa-btn" href="<?php echo e(url('contact')); ?>">Get in touch</a></p>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
