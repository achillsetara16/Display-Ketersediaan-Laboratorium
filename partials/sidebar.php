<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$role = $_SESSION['role'] ?? null;
$current = basename($_SERVER['PHP_SELF']);
?>

<!-- Tombol toggle sidebar -->
<button id="toggleSidebar" class="md:hidden fixed top-4 left-4 z-50 text-white text-3xl">
  &#9776;
</button>

<div id="sidebar" class="sidebar fixed top-0 left-0 w-64 h-full bg-[#2B7A78] text-white z-40 transform -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0 md:relative md:block">
  <div class="logo-container">
    <img src="../image/poltek.png" alt="Logo Kampus">
  </div>
  <div class="logo-divider"></div>
  <div class="border"></div>
  <ul class="nav-links">
    <?php if ($role === 'laboran'): ?>
      <li><a href="../laboran/dashboard_laboran.php" class="<?= $current == 'dashboard_laboran.php' ? 'active' : '' ?>"><i class="bi bi-house-door-fill icon"></i>Dashboard</a></li>
       <li><a href="../Super_Admin/tambah-ruangan.php" class="<?= $current == 'tambah-ruangan.php' ? 'active' : '' ?>"><i class="bi bi-plus-circle"></i> Rooms</a></li>
      <li><a href="../laboran/list-ruangan.php" class="<?= $current == 'list-ruangan.php' ? 'active' : '' ?>"><i class="bi bi-building"></i>Rooms List</a></li>
      <li><a href="../laboran/add-matkul.php" class="<?= $current == 'add-matkul.php' ? 'active' : '' ?>"><i class="bi bi-plus-circle"></i>Add Courses</a></li>
       <li><a href="../laboran/list_matkul.php" class="<?= $current == 'list_matkul.php' ? 'active' : '' ?>"><i class="bi bi-building"></i>Courses List</a></li>

    <?php elseif ($role === 'dosen'): ?>
      <li><a href="../dosen/dashboard.php" class=" <?= $current == 'dashboard.php' ? 'active' : '' ?>"><i
            class="bi bi-house-door-fill icon"></i>Dashboard</a></li>
      <li><a href="../dosen/status-dosen.php" class="<?= $current == 'status-dosen.php' ? 'active' : '' ?>"><i
            class="bi bi-person-check-fill icon"></i>Status Dosen</a></li>

    <?php elseif ($role === 'superadmin'): ?>
      <li><a href="../Super_Admin/dashboard.php" class="<?= $current == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
      <li><a href="../Super_Admin/tambah-ruangan.php" class="<?= $current == 'tambah-ruangan.php' ? 'active' : '' ?>">Add Rooms</a></li>
      <li><a href="../Super_Admin/list-ruangan.php" class="<?= $current == 'list-ruangan.php' ? 'active' : '' ?>">Rooms List</a></li>
      <li><a href="../Super_Admin/addmatkul.php" class="<?= $current == 'addmatkul.php' ? 'active' : '' ?>">Add Courses</a></li>
      <li><a href="../Super_Admin/list_matkul.php" class="<?= $current == 'list_matkul.php' ? 'active' : '' ?>">Course List</a></li>
      <li><a href="../Super_Admin/users_list.php" class="<?= $current == 'users_list.php' ? 'active' : '' ?>">Users List</a></li>
      <li><a href="../Super_Admin/loan_data.php" class="<?= $current == 'loan_data.php' ? 'active' : '' ?>">Loan Data</a></li>
    <?php else: ?>
      <li><span>Role tidak dikenali.</span></li>
    <?php endif; ?>
  </ul>
</div>

<script>
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');

  toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
  });
</script>
