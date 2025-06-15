<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $code = $_POST['code'];
    $name = $_POST['name'];
    $building = $_POST['building'];
    // Simpan data ke tabel courses
    $stmt = $pdo->prepare("INSERT INTO rooms (code, name, building)
                       VALUES (?, ?, ?)");
    $stmt->execute([$code, $name, $building]);


    echo "<p style='color: green;'>Data room berhasil disimpan ke tabel rooms.</p>";
}
?>
<link rel="stylesheet" href="../assets/css/add_ruangan.css">
<!-- Main content -->
<div class="main">
  <div class="card">
    <h2>Form Add Room</h2>
     <form action="" method="POST">
      <label for="start_time">Room Code</label>
      <input type="text" id="code" name="code" placeholder="TA 11.B" required>

      <label for="end_time">Room Name</label>
      <input type="text" id="name" name="name" placeholder="cyber and security" required>

      <label for="courses">Building</label>
      <input type="text" id="building" name="building" placeholder="Gedung A" required>
      <button type="submit">Save</button>
    </form>
  </div>
</div>

<!-- Footer -->
<?php include('../partials/footer.php'); ?>