<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $course = $_POST['courses'];
    $lecturer = $_POST['lecturer'];
    $class = $_POST['class'];
    $semester = $_POST['semester'];
    $room_id = isset($_POST['room_id']) ? $_POST['room_id'] : null;
    // Simpan data ke tabel courses
    $stmt = $pdo->prepare("INSERT INTO courses (day, start_time, end_time, course, lecturer, class, semester)
                       VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$day, $start_time, $end_time, $course, $lecturer, $class, $semester]);


    echo "<p style='color: green;'>Data mata kuliah berhasil disimpan ke tabel courses.</p>";
}
?>

<link rel="stylesheet" href="../assets/css/add-matkul.css">

<!-- Main content -->
<div class="main">
  <div class="card">
    <h2>Form Add Courses</h2>
    <form action="" method="POST">
      <label for="day">Day</label>
      <input type="text" id="day" name="day" required>

      <label for="start_time">Start Time</label>
      <input type="time" id="start_time" name="start_time" required>

      <label for="end_time">End Time</label>
      <input type="time" id="end_time" name="end_time" required>

      <label for="courses">Courses</label>
      <input type="text" id="courses" name="courses" required>

      <label for="lecturer">Lecturer</label>
      <input type="text" id="lecturer" name="lecturer" required>

      <label for="class">Class</label>
      <input type="text" id="class" name="class" required>

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

<?php include('../partials/footer.php'); ?>
