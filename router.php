<?php
// router.php

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'login':
        include 'login.php';
        break;

    case 'register':
        include 'register.php';
        break;
    case 'home':
        include 'home.php';
        break;

    default:
        include 'home.php';
        break;
}
