</main>
<footer class="vsa-footer">
    <div class="vsa-container">
        <div class="vsa-footer-grid">
            <div>
                <a class="vsa-logo vsa-logo-footer" href="<?php echo e(url()); ?>">🇸🇦 <?php echo e(SITE_NAME); ?></a>
                <p><?php echo e(SITE_TAGLINE); ?>.</p>
            </div>
            <div>
                <h4>Explore</h4>
                <ul>
                    <li><a href="<?php echo e(url('destinations')); ?>">Destinations</a></li>
                    <li><a href="<?php echo e(url('attractions')); ?>">Attractions</a></li>
                    <li><a href="<?php echo e(url('events')); ?>">Events</a></li>
                </ul>
            </div>
            <div>
                <h4>Plan</h4>
                <ul>
                    <li><a href="<?php echo e(url('guides')); ?>">Travel Guides</a></li>
                    <li><a href="<?php echo e(url('guides/saudi-arabia-evisa-guide')); ?>">Visa Guide</a></li>
                    <li><a href="<?php echo e(url('guides/best-time-to-visit-saudi-arabia')); ?>">Best Time to Visit</a></li>
                </ul>
            </div>
            <div>
                <h4>About</h4>
                <ul>
                    <li><a href="<?php echo e(url('about')); ?>">About Us</a></li>
                    <li><a href="<?php echo e(url('contact')); ?>">Contact</a></li>
                    <li><a href="<?php echo e(url('search')); ?>">Search</a></li>
                </ul>
            </div>
        </div>
        <p class="vsa-footer-disclaimer">
            © <?php echo date('Y'); ?> <?php echo e(SITE_NAME); ?>. Independent travel guide — not affiliated with the Saudi Tourism Authority.
            Always verify visa, event and opening information with official sources before travel.
        </p>
    </div>
</footer>
<script src="<?php echo e(asset('js/main.js')); ?>"></script>
</body>
</html>
