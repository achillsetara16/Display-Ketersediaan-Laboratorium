<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<link rel="stylesheet" href="../assets/css/add-matkul.css">


<!-- Main content -->
<div class="main">
  <div class="card">
    <h2>Form Tambah Matakuliah</h2>
   <form action="proses_tambah_matkul.php" method="POST">
      <label for="kode">Kode Matakuliah</label>
      <input type="text" id="kode" name="kode" placeholder="Contoh: IF1234" required>

      <label for="nama">Nama Matakuliah</label>
      <input type="text" id="nama" name="nama" placeholder="Contoh: Pemrograman Web" required>

      <label for="sks">Jumlah SKS</label>
      <input type="number" id="sks" name="sks" min="1" max="6" required>

      <label for="semester">Semester</label>
      <select id="semester" name="semester" required>
        <option value="">-- Pilih Semester --</option>
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
        <option value="4">Semester 4</option>
        <option value="5">Semester 5</option>
        <option value="6">Semester 6</option>
      </select>

      <button type="submit">Save</button>
    </form>
  </div>
</div>

<!-- Footer -->
<?php include('../partials/footer.php'); ?>