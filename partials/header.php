<?php
session_start();
$role = $_SESSION['role'] ?? 'guest';
$current = basename($_SERVER['PHP_SELF']); // untuk mengetahui nama file saat ini

$profileLink = '#';
if ($role === 'dosen') {
  $profileLink = '../dosen/profile.php';
} elseif ($role === 'laboran') {
  $profileLink = '../laboran/profile.php';
}
elseif ($role === 'masteradmin') {
  $profileLink = '../Super_Admin/profile.php';
}

$user = $_SESSION['user'] ?? ['profile_photo_path' => null];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
          echo 'Status Lecturer';
          break;
        case 'status-rooms.php':
          echo 'Status Rooms';
          break;
        case 'list-ruangan.php':
          echo 'Rooms List';
          break;
        case 'add-matkul.php':
          echo 'Add Course';
          break;
        case 'tambah-ruangan.php':
          echo 'Add Rooms';
          break;
         case 'list_matkul.php':
          echo 'Courses List';
          break;
           case 'users_list.php':
          echo 'Users List';
          break;
           case 'loan_data.php':
          echo 'Loan Data';
          break;
      }
      ?>
    </span>

    <div class="dropdown-container">
      <!-- Avatar Button -->
      <button id="avatarBtn">
        <img class="profile-logo"
          src="<?= $user['profile_photo_path'] ? '../storage/' . $user['profile_photo_path'] : 'https://th.bing.com/th/id/OIP.Icb6-bPoeUmXadkNJbDP4QHaHa?pid=ImgDet&w=178&h=178&c=7&dpr=1,5' ?>"
          alt="Foto Profil" />
      </button>

      <!-- Dropdown Menu -->
      <div id="dropdownMenu" class="dropdown-menu">
        <ul>
          <li><a href="<?= $profileLink ?>"><i class="bi bi-person-circle"></i> Lihat Profil</a></li>
          <li><a href="../auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
        </ul>
      </div>
    </div>
    


    <!-- JavaScript -->
    <script>
      const avatarBtn = document.getElementById('avatarBtn');
      const dropdownMenu = document.getElementById('dropdownMenu');

      avatarBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
      });

      document.addEventListener('click', function () {
        dropdownMenu.style.display = 'none';
      });
    </script>

  </div>
</body>