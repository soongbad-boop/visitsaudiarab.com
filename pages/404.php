<?php
http_response_code(404);
$meta_title = 'Page not found — ' . SITE_NAME;
require ROOT_PATH . '/includes/header.php';
?>
<section class="vsa-section vsa-container vsa-content" style="text-align:center;padding:80px 0;">
    <h1 style="font-size:3rem;margin:0;">🧭 404</h1>
    <p>This page wandered off into the Empty Quarter.</p>
    <p><a class="vsa-btn" href="<?php echo e(url()); ?>">Back to home</a></p>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
