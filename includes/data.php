<?php
/**
 * JSON file storage — no database required.
 * Content lives in /data/*.json and is seeded automatically on first run.
 */

function vsa_all($type) {
    static $cache = [];
    if (!isset($cache[$type])) {
        $file = DATA_PATH . '/' . $type . '.json';
        $cache[$type] = is_file($file)
            ? (json_decode(file_get_contents($file), true) ?: [])
            : [];
    }
    return $cache[$type];
}

function vsa_find($type, $slug) {
    foreach (vsa_all($type) as $row) {
        if (($row['slug'] ?? '') === $slug) return $row;
    }
    return null;
}

function vsa_where($type, $key, $value) {
    return array_values(array_filter(vsa_all($type), function ($row) use ($key, $value) {
        return ($row[$key] ?? null) === $value;
    }));
}

function vsa_save($type, array $rows) {
    if (!is_dir(DATA_PATH)) mkdir(DATA_PATH, 0755, true);
    file_put_contents(
        DATA_PATH . '/' . $type . '.json',
        json_encode(array_values($rows), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );
}

function vsa_append($type, array $row) {
    $rows = vsa_all($type);
    $rows[] = $row;
    vsa_save($type, $rows);
}

/** Search every content type; returns ['type' => [rows]]. */
function vsa_search_all($q) {
    $q = mb_strtolower(trim($q));
    $results = ['destinations' => [], 'attractions' => [], 'events' => [], 'posts' => []];
    if ($q === '') return $results;

    foreach (array_keys($results) as $type) {
        foreach (vsa_all($type) as $row) {
            $haystack = mb_strtolower(implode(' ', array_filter([
                $row['name'] ?? '', $row['title'] ?? '', $row['tagline'] ?? '',
                $row['excerpt'] ?? '', $row['description'] ?? '', $row['content'] ?? '',
                $row['city'] ?? '', $row['region'] ?? '', $row['category'] ?? '',
                is_array($row['tags'] ?? null) ? implode(' ', $row['tags']) : ($row['tags'] ?? ''),
            ])));
            if (mb_strpos($haystack, $q) !== false) {
                $results[$type][] = $row;
            }
        }
    }
    return $results;
}

/** Write seed content files when they don't exist yet. */
function vsa_seed_if_empty() {
    require_once ROOT_PATH . '/includes/seed.php';
    $seed = vsa_seed_data();
    foreach ($seed as $type => $rows) {
        if (!is_file(DATA_PATH . '/' . $type . '.json')) {
            vsa_save($type, $rows);
        }
    }
}
