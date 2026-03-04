<?php
/**
 * PHP Router for development server
 * Handles static files before passing to Laravel
 */

$file = __DIR__ . '/public' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the file exists and is not a directory, serve it
if (is_file($file)) {
    // Determine MIME type
    $mime_types = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'ico' => 'image/x-icon',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'webp' => 'image/webp',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
        'html' => 'text/html',
    ];

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mime = $mime_types[$ext] ?? 'application/octet-stream';

    header('Content-Type: ' . $mime);
    header('Cache-Control: public, max-age=86400');
    readfile($file);
    return true;
}

// Otherwise, let Laravel handle it
return false;
