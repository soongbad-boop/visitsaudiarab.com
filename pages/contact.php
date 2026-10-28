<?php
$meta_title = 'Contact — ' . SITE_NAME;
require ROOT_PATH . '/includes/header.php';

$sent  = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Newsletter signup from the homepage form
    if (!empty($_POST['newsletter'])) {
        $email = trim($_POST['email'] ?? '');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            vsa_append('subscribers', ['email' => $email, 'at' => date('c')]);
            $sent = true;
        } else {
            $error = 'Please enter a valid email address.';
        }
    } else {
        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');
        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === '') {
            $error = 'Please fill in your name, a valid email address and a message.';
        } else {
            vsa_append('messages', [
                'name' => $name, 'email' => $email,
                'message' => $message, 'at' => date('c'),
            ]);
            $sent = true;
        }
    }
}
?>
<section class="vsa-section vsa-container vsa-content">
    <h1>Contact Us</h1>

    <?php if ($sent): ?>
        <div class="vsa-alert">✓ Thank you! We've received your message and will reply soon.</div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="vsa-alert vsa-alert-error"><?php echo e($error); ?></div>
    <?php endif; ?>

    <form class="vsa-form" method="post" action="<?php echo e(url('contact')); ?>">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="6" required></textarea>

        <button class="vsa-btn" type="submit">Send message</button>
    </form>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
