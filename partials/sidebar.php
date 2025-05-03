<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$role = $_SESSION['role'] ?? null;

$current = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">
  <div class="logo-container">
  <img src="../assets/image/Logo Polibatam 2024.png" alt="Logo Kampus">
    <h3>Web <?= ucfirst($role ?? 'User') ?></h3>
  </div>
  <div class="border"></div>
  <ul class="nav-links">
    <?php if ($role === 'laboran'): ?>
      <li><a href="/Laboran/dashboard.php" class="<?= $current == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
      <li><a href="/Laboran/list-ruangan.php" class="<?= $current == 'list-ruangan.php' ? 'active' : '' ?>">List Ruangan</a></li>
      <li><a href="/Laboran/add-matkul.php" class="<?= $current == 'add-matkul.php' ? 'active' : '' ?>">Add Matkul</a></li>
      <li><a href="/Laboran/status-rooms.php" class="<?= $current == 'status-rooms.php' ? 'active' : '' ?>">Status Rooms</a></li>

    <?php elseif ($role === 'dosen'): ?>
      <li><a href="/Dosen/dashboard.php" class="<?= $current == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
      <li><a href="/Dosen/status-dosen.php" class="<?= $current == 'status-dosen.php' ? 'active' : '' ?>">Status Dosen</a></li>

    <?php elseif ($role === 'super_admin'): ?>
      <li><a href="/Super_Admin/dashboard.php" class="<?= $current == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
      <li><a href="/Super_Admin/list-ruangan.php" class="<?= $current == 'list-ruangan.php' ? 'active' : '' ?>">List Ruangan</a></li>
      <li><a href="/Super_Admin/add-matkul.php" class="<?= $current == 'add-matkul.php' ? 'active' : '' ?>">Add Matkul</a></li>
      <li><a href="/Super_Admin/status-rooms.php" class="<?= $current == 'status-rooms.php' ? 'active' : '' ?>">Status Rooms</a></li>
      <li><a href="/Super_Admin/tambah-ruangan.php" class="<?= $current == 'tambah-ruangan.php' ? 'active' : '' ?>">Tambah Ruangan</a></li>
      
    <?php else: ?>
      <li><span>Role tidak dikenali.</span></li>
    <?php endif; ?>
    <li><a href="../auth/logout.php" class="logout">Logout</a></li>
  </ul>
</div>
