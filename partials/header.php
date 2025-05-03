<?php
session_start();
$role = $_SESSION['role'] ?? 'guest';
$current = basename($_SERVER['PHP_SELF']); // untuk mengetahui nama file saat ini
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard</title>
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>
<body>

<div class="topbar" id="pageTitle">
<span style="margin-left: 15px;">
  <?php
    switch ($current) {
      case 'dashboard.php':
      case 'dashboard_laboran.php':
      case 'masteradmin.php':
        echo 'Dashboard';
        break;
      case 'status-dosen.php':
        echo 'Status Dosen';
        break;
      case 'status-rooms.php':
        echo 'Status Rooms';
        break;
      case 'list-ruangan.php':
        echo 'List Ruangan';
        break;
      case 'add-matkul.php':
        echo 'Tambah Matkul';
        break;
      case 'tambah-ruangan.php':
        echo 'Tambah Ruangan';
        break;
      default:
        echo 'Halaman';
    }
  ?>
</span>

  <img src="../img/download.png" alt="Profile" class="profile-logo" />
</div>
