<link rel="stylesheet" href="../assets/css/add_ruangan.css">
<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<?php include ('../config/db.php'); ?>


<!-- Main content -->
<div class="main">
  <div class="card">
    <h2>Form Add Room</h2>
    <form>
      <label for="start_time">Room Code</label>
      <input type="text" id="roomcode" name="roomcode" placeholder="TA 11.B" required>

      <label for="end_time">Room Name</label>
      <input type="text" id="roomname" name="roomname" placeholder="cyber and security" required>

      <label for="courses">Building</label>
      <input type="text" id="building" name="building" placeholder="Gedung A" required>
      <button type="submit">Save</button>
    </form>
  </div>
</div>

<!-- Footer -->
<?php include('../partials/footer.php'); ?>