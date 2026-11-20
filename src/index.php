<?php
session_start();
require 'config/database.php';
require 'controllers/LecturerController.php';
require 'controllers/CourseController.php';
require 'controllers/PublicationController.php';

function e($v)
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}

function flash($type = null, $msg = null)
{
    if ($type) {
        $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
        return null;
    }
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}

function redirect($page, $extra = '')
{
    header("Location: index.php?page=$page$extra");
    exit;
}

$routes = [
    'lecturers'    => 'LecturerController',
    'courses'      => 'CourseController',
    'publications' => 'PublicationController',
];

$page = $_GET['page'] ?? 'lecturers';
if (!isset($routes[$page])) {
    http_response_code(404);
    exit('Halaman tidak ditemukan.');
}

$action = $_GET['action'] ?? 'index';
if (!in_array($action, ['index', 'store', 'update', 'delete'], true)) {
    $action = 'index';
}
// store, update, delete hanya boleh lewat POST
if ($action !== 'index' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect($page);
}

(new $routes[$page]($conn))->$action();
