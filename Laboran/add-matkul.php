<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');

// Ambil daftar ruangan dari tabel rooms
$roomStmt = $pdo->query("SELECT id, code, name FROM rooms");
$rooms = $roomStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $course = $_POST['courses'];
    $lecturer = $_POST['lecturer'];
    $class = $_POST['class'];
    $semester = $_POST['semester'] ?? null;
    $room_id = isset($_POST['room_id']) ? $_POST['room_id'] : null;

   // Validasi jadwal bentrok
$cekJadwal = $pdo->prepare("
    SELECT * FROM courses 
    WHERE day = ? AND room_id = ?
    AND start_time < ? AND end_time > ?
");
$cekJadwal->execute([
    $day,
    $room_id,
    $end_time,
    $start_time
]);
    if ($cekJadwal->rowCount() > 0) {
        echo "<script>alert('Jadwal bentrok dengan jadwal lain di ruangan ini! Silakan pilih waktu lain.');</script>";
    } else {
        // Simpan ke tabel courses (jika tidak bentrok)
        $stmt = $pdo->prepare("INSERT INTO courses (day, start_time, end_time, course, lecturer, class, semester, room_id)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$day, $start_time, $end_time, $course, $lecturer, $class, $semester, $room_id]);

        echo "<script>alert('Data berhasil disimpan.');</script>";
    }
}
?>

<link rel="stylesheet" href="../assets/css/add-matkul.css">

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
      
      <!-- <label for="semester">Semester</label>
      <select id="semester" name="semester" required>
        <option value="">-- Pilih Semester --</option>
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
        <option value="4">Semester 4</option>
        <option value="5">Semester 5</option>
        <option value="6">Semester 6</option>
      </select> -->
      <label for="room_id">Room</label>
      <select name="room_id" required>
    <option value="">--Select Room--</option>
    <?php foreach ($rooms as $room): ?>
        <option value="<?= htmlspecialchars($room['id']) ?>">
            <?= htmlspecialchars($room['code']) . " - " . htmlspecialchars($room['name']) ?>
        </option>
    <?php endforeach; ?>
</select>


      <button type="submit">Save</button>
    </form>
  </div>
</div>

<?php include('../partials/footer.php'); ?>
