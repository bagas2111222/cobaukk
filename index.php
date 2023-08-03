<?php
@ob_start();
session_start();

// Rest of the code remains the same ...

if (!empty($_SESSION['admin']) || !empty($_SESSION['role'])) {
    require 'config.php';
    include $view;
    $lihat = new view($config);
    $toko = $lihat->toko();

    // Check the role of the user and include the appropriate template files
    if ($_SESSION['role'] == 'admin') {
        // Admin
        include 'admin/template/header.php';
        include 'admin/template/sidebar.php';
        if (!empty($_GET['page'])) {
            include 'admin/module/' . $_GET['page'] . '/index.php';
        } else {
            include 'admin/template/home.php';
        }
        include 'admin/template/footer.php';
        // End Admin
    } elseif ($_SESSION['role'] == 'kasir') {
        // Kasir
        include 'kasir/template/header.php';
        include 'kasir/template/sidebar.php';
        if (!empty($_GET['page'])) {
            include 'kasir/module/' . $_GET['page'] . '/index.php';
        } else {
            include 'kasir/template/home.php';
        }
        include 'kasir/template/footer.php';
        // End Kasir
    }
} else {
    echo '<script>window.location="login.php";</script>';
    exit;
}
?>
