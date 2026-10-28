<?php
/**
 * Core helper functions.
 */

/** Escape output for HTML. */
function e($string) {
    return htmlspecialchars((string) $string, ENT_QUOTES, 'UTF-8');
}

/** Build an internal URL. */
function url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

/** Build an asset URL. */
function asset($path) {
    return url('assets/' . ltrim($path, '/'));
}

/** Redirect and stop. */
function redirect($path) {
    header('Location: ' . (preg_match('#^https?://#', $path) ? $path : url($path)));
    exit;
}

/** Format a date string. */
function format_date($date, $format = 'F j, Y') {
    if (!$date) return '';
    return date($format, strtotime($date));
}

/** Truncate plain text. */
function truncate($text, $length = 150) {
    $text = trim(strip_tags((string) $text));
    if (mb_strlen($text) <= $length) return $text;
    return rtrim(mb_substr($text, 0, $length)) . '…';
}

/** Convert plain text with blank lines into <p> paragraphs. */
function paragraphs($text) {
    $text = trim((string) $text);
    if ($text === '') return '';
    $blocks = preg_split('/\n\s*\n/', $text);
    $html = '';
    foreach ($blocks as $block) {
        $html .= '<p>' . nl2br(e(trim($block))) . '</p>';
    }
    return $html;
}

/** Rough reading time. */
function reading_time($text) {
    $words = str_word_count(strip_tags((string) $text));
    return max(1, (int) ceil($words / 200));
}

/** Current page slug for nav highlighting. */
function current_section() {
    global $page;
    return $page === '' ? 'home' : $page;
}

/** Render a card for any content type. */
function render_card($type, $item) {
    $single = $type === 'posts' ? 'guides' : $type;
    $title  = $item['name'] ?? $item['title'] ?? '';
    $sub    = $item['tagline'] ?? $item['excerpt'] ?? ($item['city'] ?? '');
    $emoji  = $item['emoji'] ?? '📍';
    $grad   = $item['gradient'] ?? 'g1';
    echo '<a class="vsa-card" href="' . e(url($single . '/' . $item['slug'])) . '">';
    echo '<div class="vsa-card-img ' . e($grad) . '" aria-hidden="true"><span>' . e($emoji) . '</span></div>';
    echo '<div class="vsa-card-body"><h3>' . e($title) . '</h3><span>' . e(truncate($sub, 70)) . '</span></div>';
    echo '</a>';
}
