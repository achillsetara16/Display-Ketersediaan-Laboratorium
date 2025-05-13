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
      <li><a href="../laboran/dashboard_laboran.php"
          class="<?= $current == 'dashboard_laboran.php' ? 'active' : '' ?>">Dashboard</a></li>
      <li><a href="../laboran/list-ruangan.php" class="<?= $current == 'list-ruangan.php' ? 'active' : '' ?>">List
          Ruangan</a></li>
      <li><a href="../laboran/add-matkul.php" class="<?= $current == 'add-matkul.php' ? 'active' : '' ?>">Add Matkul</a>
      </li>
      <li><a href="../laboran/status-rooms.php" class="<?= $current == 'status-rooms.php' ? 'active' : '' ?>">Status
          Rooms</a></li>

    <?php elseif ($role === 'dosen'): ?>
      <li><a href="../dosen/dashboard.php" class=" <?= $current == 'dashboard.php' ? 'active' : '' ?>"><i
            class="bi bi-house-door-fill icon"></i>Dashboard</a></li>
      <li><a href="../dosen/status-dosen.php" class="<?= $current == 'status-dosen.php' ? 'active' : '' ?>"><i
            class="bi bi-person-check-fill icon"></i>Status Dosen</a></li>

    <?php elseif ($role === 'super_admin'): ?>
      <li><a href="../Super_Admin/masteradmin.php"
          class="<?= $current == 'masteradmin.php' ? 'active' : '' ?>">Dashboard</a></li>
      <li><a href="../Super_Admin/list-ruangan.php" class="<?= $current == 'list-ruangan.php' ? 'active' : '' ?>">List
          Ruangan</a></li>
      <li><a href="../Super_Admin/add-matkul.php" class="<?= $current == 'add-matkul.php' ? 'active' : '' ?>">Add
          Matkul</a></li>
      <li><a href="../Super_Admin/status-rooms.php" class="<?= $current == 'status-rooms.php' ? 'active' : '' ?>">Status
          Rooms</a></li>
      <li><a href="../Super_Admin/tambah-ruangan.php"
          class="<?= $current == 'tambah-ruangan.php' ? 'active' : '' ?>">Tambah Ruangan</a></li>

    <?php else: ?>
      <li><span>Role tidak dikenali.</span></li>
    <?php endif; ?>
  </ul>
</div>