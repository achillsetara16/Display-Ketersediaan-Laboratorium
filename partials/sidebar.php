<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$role = $_SESSION['role'] ?? null;
$current = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
  <div class="logo-container">
    <img src="../image/poltek.png" alt="Logo Kampus">
  </div>
  <div class="logo-divider"></div>
  <div class="border"></div>
  <ul class="nav-links">
    <?php if ($role === 'laboran'): ?>
      <li><a href="../laboran/dashboard_laboran.php" class="<?= $current == 'dashboard_laboran.php' ? 'active' : '' ?>"><i class="bi bi-house-door-fill icon"></i>Dashboard</a></li>
      <li><a href="../laboran/list-ruangan.php" class="<?= $current == 'list-ruangan.php' ? 'active' : '' ?>"><i class="bi bi-building"></i>List Ruangan</a></li>
      <li><a href="../laboran/add-matkul.php" class="<?= $current == 'add-matkul.php' ? 'active' : '' ?>"><i class="bi bi-plus-circle"></i>Add Matkul</a></li>
      <li><a href="../laboran/status-rooms.php" class="<?= $current == 'status-rooms.php' ? 'active' : '' ?>"><i class="bi bi-list-task"></i>Status Rooms</a></li>

    <?php elseif ($role === 'dosen'): ?>
      <li><a href="../dosen/dashboard.php" class=" <?= $current == 'dashboard.php' ? 'active' : '' ?>"><i
            class="bi bi-house-door-fill icon"></i>Dashboard</a></li>
      <li><a href="../dosen/status-dosen.php" class="<?= $current == 'status-dosen.php' ? 'active' : '' ?>"><i
            class="bi bi-person-check-fill icon"></i>Status Dosen</a></li>

    <?php elseif ($role === 'superadmin'): ?>
      <li><a href="../Super_Admin/dashboard.php"
          class="<?= $current == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
      <li><a href="../Super_Admin/list-ruangan.php" class="<?= $current == 'list-ruangan.php' ? 'active' : '' ?>">Rooms List</a></li>
      <li><a href="../Super_Admin/addmatkul.php" class="<?= $current == 'addmatkul.php' ? 'active' : '' ?>">Add Courses</a></li>
      <li><a href="../Super_Admin/list_matkul.php" class="<?= $current == 'list_matkul.php' ? 'active' : '' ?>">Course List
      </a></li>
      <li><a href="../Super_Admin/status-rooms.php" class="<?= $current == 'status-rooms.php' ? 'active' : '' ?>">Status
          Rooms</a></li>
      <li><a href="../Super_Admin/tambah-ruangan.php"
          class="<?= $current == 'tambah-ruangan.php' ? 'active' : '' ?>">Add Rooms</a></li>

    <?php else: ?>
      <li><span>Role tidak dikenali.</span></li>
    <?php endif; ?>
  </ul>
</div>