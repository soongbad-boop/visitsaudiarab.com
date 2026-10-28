<?php
/** Shared header. Pages may set $meta_title and $meta_desc before including. */
$meta_title = $meta_title ?? SITE_NAME . ' — ' . SITE_TAGLINE;
$meta_desc  = $meta_desc  ?? SITE_TAGLINE;
$active     = current_section();
$nav = [
    ''            => 'Home',
    'destinations'=> 'Destinations',
    'attractions' => 'Attractions',
    'events'      => 'Events',
    'guides'      => 'Guides',
    'about'       => 'About',
    'contact'     => 'Contact',
];
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($meta_title); ?></title>
<meta name="description" content="<?php echo e($meta_desc); ?>">
<link rel="icon" href="<?php echo e(asset('images/favicon.ico')); ?>" type="image/x-icon">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<header class="vsa-header">
    <div class="vsa-container vsa-header-inner">
        <a class="vsa-logo" href="<?php echo e(url()); ?>">🇸🇦 <?php echo e(SITE_NAME); ?></a>
        <button class="vsa-nav-toggle" aria-label="Menu" aria-expanded="false">☰</button>
        <nav class="vsa-nav" id="vsa-nav">
            <ul>
                <?php foreach ($nav as $key => $label): ?>
                    <li><a href="<?php echo e(url($key)); ?>"<?php echo $active === $key || ($key === '' && $active === 'home') ? ' class="active"' : ''; ?>><?php echo e($label); ?></a></li>
                <?php endforeach; ?>
                <li><a class="vsa-nav-search" href="<?php echo e(url('search')); ?>" aria-label="Search">🔍</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
