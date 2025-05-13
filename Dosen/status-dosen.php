<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<link rel="stylesheet" href="../assets/css/status-dosen.css">
<script type="module" src="../assets/js/status-dosen.js"></script>

<div class="main-content">
  <div class="card">
    <h2 id="pageCaption">Perbarui Status Kehadiran Anda</h2>
    <form id="statusForm">
      <label for="status">Status Saat Ini:</label>
      <select id="status">
        <option value="Ada">Ada di Ruang Dosen</option>
        <option value="Tidak Ada">Tidak Ada di Ruang Dosen</option>
      </select>
      <button type="submit">Simpan Status</button>
    </form>

    <div class="status-display" id="displayStatus">
      <span class="status-icon" id="iconStatus">⏳</span>
      Status saat ini: <span id="currentStatus">Belum diset</span>
    </div>
  </div>
</div>