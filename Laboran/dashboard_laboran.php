<?php
session_start();
$_SESSION['role'] = 'laboran'; // dummy role, di real case ambil dari login

include '../partials/header.php';
include '../partials/sidebar.php';
?>

<div style="padding: 20px; flex-grow: 1;">
    <h1>Dashboard Laboran</h1>
    <p>Selamat datang, Laboran!</p>
</div>

<?php include '../partials/footer.php'; ?>
