<?php
$meta_title = SITE_NAME . ' — ' . SITE_TAGLINE;
require ROOT_PATH . '/includes/header.php';

$destinations = vsa_all('destinations');
$attractions  = array_slice(vsa_all('attractions'), 0, 6);
$events       = array_slice(vsa_all('events'), 0, 3);
$guides       = vsa_all('posts');
usort($guides, fn($a, $b) => strcmp($b['published_at'], $a['published_at']));
$guides = array_slice($guides, 0, 4);

$plan_links = [
    ['🛂 Visa Guide',        'guides/saudi-arabia-evisa-guide'],
    ['📅 Best Time to Visit','guides/best-time-to-visit-saudi-arabia'],
    ['🚄 Getting Around',    'guides/getting-around-saudi-arabia'],
    ['🍽️ Food Guide',        'guides/saudi-food-guide'],
    ['🧕 Dress & Etiquette', 'guides/dress-code-and-etiquette'],
    ['💰 Travel Costs',      'guides/saudi-arabia-travel-costs'],
];
?>

<section class="vsa-hero">
    <div class="vsa-container">
        <h1>Explore Saudi Arabia</h1>
        <p>Independent travel guides, itineraries, attractions and local recommendations from across the Kingdom.</p>
        <form class="vsa-search" role="search" method="get" action="<?php echo e(url('search')); ?>">
            <input type="search" name="q" placeholder="Where do you want to go?" aria-label="Search">
            <button type="submit">Search</button>
        </form>
    </div>
</section>

<section class="vsa-section vsa-container">
    <h2>Trending Destinations</h2>
    <p class="vsa-sub">From ancient Nabataean tombs to Red Sea reefs.</p>
    <div class="vsa-grid">
        <?php foreach ($destinations as $d) render_card('destinations', $d); ?>
    </div>
</section>

<section class="vsa-section vsa-section-alt">
    <div class="vsa-container">
        <h2>Plan Your Trip</h2>
        <p class="vsa-sub">The essential reads before you book.</p>
        <div class="vsa-grid">
            <?php foreach ($plan_links as $l): ?>
                <a class="vsa-card" href="<?php echo e(url($l[1])); ?>">
                    <div class="vsa-card-body"><h3><?php echo e($l[0]); ?></h3></div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="vsa-section vsa-container">
    <h2>Top Attractions</h2>
    <div class="vsa-grid">
        <?php foreach ($attractions as $a) render_card('attractions', $a); ?>
    </div>
</section>

<section class="vsa-section vsa-section-alt">
    <div class="vsa-container">
        <h2>Festivals &amp; Events</h2>
        <p class="vsa-sub">Seasons and spectacles worth planning around.</p>
        <div class="vsa-grid">
            <?php foreach ($events as $ev) render_card('events', $ev); ?>
        </div>
        <a class="vsa-btn" href="<?php echo e(url('events')); ?>">All events →</a>
    </div>
</section>

<section class="vsa-section vsa-container">
    <h2>Latest Travel Guides</h2>
    <div class="vsa-grid">
        <?php foreach ($guides as $g) render_card('posts', $g); ?>
    </div>
</section>

<section class="vsa-container">
    <div class="vsa-newsletter">
        <h2>Discover something new in Saudi every week.</h2>
        <p class="vsa-sub">One email a week — new guides, festival dates and local tips. No spam.</p>
        <form class="vsa-search" method="post" action="<?php echo e(url('contact')); ?>">
            <input type="hidden" name="newsletter" value="1">
            <input type="email" name="email" placeholder="Your email address" required aria-label="Email">
            <button type="submit">Subscribe</button>
        </form>
    </div>
</section>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
