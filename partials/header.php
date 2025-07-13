<?php
<<<<<<< HEAD
$current = basename($_SERVER['PHP_SELF']);
?>
<!-- HEADER START -->
<header class="header">
  <div class="header__inner">
    <div>
      <h1 class="header-title">
        <?php
          echo match($current){
            'display_class.php' => 'Class Room Display',
            'display_dosen.php' => 'Lecturer Room Display',
            default             => 'Real-Time Display'
          };
        ?>
      </h1>
      <p class="header-subtitle">Informatics Engineering & Internet of Things</p>
=======
session_start();
$role = $_SESSION['role'] ?? 'guest';
$current = basename($_SERVER['PHP_SELF']); // untuk mengetahui nama file saat ini

$profileLink = '#';
if ($role === 'dosen') {
  $profileLink = '../dosen/profile.php';
} elseif ($role === 'laboran') {
  $profileLink = '../laboran/profile.php';
}
elseif ($role === 'superadmin') {
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
        case 'dashboardadmin.php':
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
>>>>>>> 9ae39ad062dc6201bdc3f018884f7e832e869405
    </div>

    <div class="datetime">
      <span class="header-datetime__item" id="date"></span>
      <span class="header-datetime__item" id="time"></span>
    </div>
  </div>
</header>

<style>
  .header {
    background: linear-gradient(135deg, var(--blue-700), var(--blue-800), var(--blue-900));
    color: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, .25);
  }

  .header__inner {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
  }

  .header-title {
    font-family: "Lora", serif;
    font-size: clamp(2.2rem, 4vw + 1rem, 3.5rem);
    font-weight: 700;
    text-shadow: 0 2px 8px rgba(0, 0, 0, .3);
  }

  .header-subtitle {
    font-size: clamp(1rem, 2vw + .5rem, 1.4rem);
    font-weight: 600;
    margin-top: .4rem;
    color: rgba(255, 255, 255, .95);
    text-shadow: 0 1px 4px rgba(0, 0, 0, .2);
  }

  .datetime {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-weight: 700;
  }

  .header-datetime__item {
    background: rgba(255, 255, 255, .15);
    border: 1px solid rgba(255, 255, 255, .3);
    color: #fff;
    padding: .9rem 1.5rem;
    border-radius: .75rem;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
    white-space: nowrap;
  }

  .header-datetime__item:hover {
    transform: translateY(-1px);
    background: rgba(255, 255, 255, .2);
    box-shadow: 0 4px 12px rgba(0, 0, 0, .2);
  }

  @media(max-width:768px){
    .header__inner {
      flex-direction: column;
      text-align: center;
      gap: 1.5rem;
    }
    .header-title { font-size: 2rem; }
    .header-subtitle { font-size: 1rem; }
    .datetime { justify-content: center; }
    .header-datetime__item { font-size: .95rem; padding: .8rem 1.2rem; }
  }
</style>

<script>
  function tick() {
    const now = new Date();
    document.getElementById("date").textContent = now.toLocaleDateString("en-GB", {
      weekday: "long", year: "numeric", month: "long", day: "numeric"
    });
    document.getElementById("time").textContent = now.toLocaleTimeString("en-GB", {
      hour: "2-digit", minute: "2-digit", second: "2-digit"
    });
  }
  tick();
  setInterval(tick, 1000);
</script>
<!-- HEADER END -->
