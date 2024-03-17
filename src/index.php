<?php declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$config = file_exists('config.php') ? (require_once('config.php')) : [];
// echo('<pre>'.print_r($config, true).'</pre>');
// echo('<pre>'.print_r($_REQUEST, true).'</pre>');
if (array_key_exists('path', $config)) {
    $path = rtrim($config['path'], '/');
    if (!empty(trim($path))) {
        $path = $path . '/';
    }
} else {
    $config['path'] = 'data/';
}


$album = '';
if (array_key_exists('album', $_REQUEST)) {
    $album = $_REQUEST['album'];
    $session_key = 'album_' . $album;
    $access_ok = false;
    if (array_key_exists($album, $config['albums'])) {
        if (array_key_exists('secret', $_REQUEST)) {
            if ($config['albums'][$album]['secret'] === $_REQUEST['secret']) {
                $access_ok = true;
                $_SESSION[$session_key] = $_REQUEST['secret'];
            }
        } elseif (array_key_exists($session_key, $_SESSION) && $_SESSION[$session_key] === $config['albums'][$album]['secret']) {
            $access_ok = true;
        }
    }
    if ($access_ok === false) {
        include('view/secret.php');
        exit;
    }
} else {
    $albums = [];
    foreach ($config['albums'] as $album_key => $album_config) {
        $albums[$album_key] = $album_config['title'];
    }
    // uses $albums
    include('view/index.php');
    exit;
}

$low_res = trim($config['albums'][$album]['low-res'] ?? '640', '/ ') . '/';
$high_res = trim($config['albums'][$album]['low-res'] ?? '1920', '/ ') . '/';

// collect all icons that do not start with a dot
$photos = array_values(array_filter(scandir($config['path'] . $album . '/'. $low_res), (fn ($v) => !str_starts_with($v, '.'))));

// uses:
// - $photos
// - $album_folder
// - $low_res
// - $high_res
include('view/gallery.php');
