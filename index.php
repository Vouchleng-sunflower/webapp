<?php

require_once('init/init.php');

include('includes/header.inc.php');
include('includes/navbar.inc.php');
if (isset($_GET['page'])) {
    $page = $_GET['page']; // about
    $admin_pages = ['user/home',
    'user/create',
    'user/update',
    'user/delete',
    'category/home',
    'category/create',
    'category/update',
    'category/delete',
    'product/home',
    'product/create',
    'product/update',
    'product/delete'
];
$user_page = [];

    $before_logIn_pages = ['login', 'register'];
    $after_logIn_pages = [
        'dashboard',
        ...$admin_pages // flat copy
    ];

    if (
        $page === 'logout'  ||
        (in_array($page, $before_logIn_pages) && !loggedInUser()) ||
        (in_array($page, $after_logIn_pages) && loggedInUser())
    ) {
        if (in_array($page, $admin_pages) && !isAdmin()) {
            header("Location: ./");
        }
        include('pages/' . $page . '.php');
    }
} else {
    include('pages/home.php');
}
include('includes/footer.inc.php');


$db->close();
