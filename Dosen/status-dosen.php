<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<link rel="stylesheet" href="../assets/css/status-dosen.css">
<script type="module" src="../assets/js/status-dosen.js"></script>

<div class="main-content">
    <div class="card">
      <h2 id="pageCaption">Update Your Attendance Status</h2>
      <form id="statusForm">
        <label for="status">Current Status:</label>
        <select id="status">
          <option value="Ada">In the Lecturer's Room</option>
          <option value="Tidak Ada">Not in the Lecturer's Room</option>
        </select>
        <button type="submit">Save Status</button>
      </form>

      <div class="status-display" id="displayStatus">
        <span class="status-icon" id="iconStatus">⏳</span>
        Status saat ini: <span id="currentStatus">Not set yet</span>
      </div>
    </div>
  </div>