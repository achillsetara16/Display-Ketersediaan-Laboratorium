<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<?php include ('../config/db.php'); ?>
<link rel="stylesheet" href="../assets/css/add-matkul.css">


<!-- Main content -->
<div class="main">
  <div class="card">
    <h2>Form Add Courses</h2>
   <form action="add_course.php" method="POST">
      <label for="day">Day</label>
      <input type="text" id="day" name="day" placeholder="Example: Thursday" required>

      <label for="start_time">Start Time</label>
      <input type="time" id="start_time" name="start_time" placeholder="Example: 20:30" required>

      <label for="end_time">End Time</label>
      <input type="time" id="end_time" name="end_time" placeholder="Example: 22:30" required>

      <label for="courses">Courses</label>
      <input type="text" id="courses" name="courses" placeholder="Example: IF420 Mata Kuliah Pilihan 2" required>

      <label for="lecturer">Lecturer</label>
      <input type="text" id="lecturer" name="lecturer" placeholder="Example: Hamdani Arif" required>

      <label for="room">Room</label>
      <input type="text" id="room" name="room" placeholder="Example: Ta. 11.4" required>

      <label for="class">Class</label>
      <input type="text" id="class" name="class" placeholder="Example: 4C" required>

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