<?php declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$config = file_exists('config.php') ? (require_once('config.php')) : [];
if (array_key_exists('path', $config)) {
    $path = rtrim($config['path'], '/');
    if (!empty(trim($path))) {
        $path = $path . '/';
    }
} else {
    $config['path'] = 'data/';
}
if (!array_key_exists('title', $config)) {
    $config['title'] = 'A Simple Photo Gallery';
}

$album = '';

if (array_key_exists('album', $_REQUEST)) {
    $album = $_REQUEST['album'];
    $session_key = 'album_' . $album;
    $access_ok = false;
    if (array_key_exists($album, $config['albums'])) {
        if (!array_key_exists('secret', $config['albums'][$album])) {
            $access_ok = true;
        } elseif (array_key_exists('secret', $_REQUEST)) {
            if ($config['albums'][$album]['secret'] === $_REQUEST['secret']) {
                $access_ok = true;
                $_SESSION[$session_key] = $_REQUEST['secret'];
            }
        } elseif (array_key_exists($session_key, $_SESSION) && $_SESSION[$session_key] === $config['albums'][$album]['secret']) {
            $access_ok = true;
        }
    }
}

if ($album === '') {
    // uses
    // - $config['title'];
    // - $config['css'];
    $albums = array_map(fn ($v) => $v['title'], $config['albums']);
    require('view/index.php');
    exit;
}

if ($access_ok === false) {
    // uses
    // - $config['title'];
    // - $config['css'];
    $title = $config['albums'][$album]['title'];
    require('view/secret.php');
    exit;
}

// uses:
// - $config['css'];
$title = $config['albums'][$album]['title'];
$album_path = $config['path'] . $album . '/';
$low_res_folder = trim($config['albums'][$album]['low-res'] ?? '640', '/ ') . '/';
$high_res_folder = trim($config['albums'][$album]['high-res'] ?? '1920', '/ ') . '/';
// collect all icons that do not start with a dot
$photos = array_values(array_filter(scandir($album_path . $low_res_folder), (fn ($v) => !str_starts_with($v, '.'))));
require('view/gallery.php');
