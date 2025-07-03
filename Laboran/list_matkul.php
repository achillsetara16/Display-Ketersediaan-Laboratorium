<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<?php include('../config/db.php'); ?>
<link rel="stylesheet" href="../assets/css/list_matkul.css">
<!-- jQuery (wajib) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<?php 
if (isset($_POST['delete_room_id'])) {
    // Handle Delete Course
    $delete_id = $_POST['delete_room_id'];
    $deleteStmt = $pdo->prepare("DELETE FROM courses WHERE id = :id");
    $deleteStmt->execute([':id' => $delete_id]);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
    ?>
<div class="main-content">
    <div class="card">
        <h2>Course List</h2>
        <table id="roomTable">
            <thead>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Day</th>
                    <th>Time</th>
                    <th>Course</th>
                    <th>Class</th>
                    <th>Lecturer</th>
                    <th>Room</th>
                    <!-- <th>Semester</th> -->
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Ambil data dari tabel courses
                    $stmt = $pdo->query("SELECT courses.*, rooms.code AS room_code
                     FROM courses
                     JOIN rooms ON courses.room_id = rooms.id");

                    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($courses as $row) {
                        echo "<tr>";
                        // echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['day']) . "</td>";
                        echo "<td>" . date("H.i", strtotime($row['start_time'])) . " - " . date("H.i", strtotime($row['end_time'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['course']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['class']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lecturer']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['room_code']) . "</td>";
                        // echo "<td>" . htmlspecialchars($row['semester']) . "</td>";
                         // Kolom Aksi
                        echo "<td class='aksi-cell'>";
                        // Form Delete Room
                        echo "<form method='POST' onsubmit=\"return confirm('Are you sure want to delete this?');\" style='display:inline-block;'>";
                        echo "<input type='hidden' name='delete_room_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='delete-button' style='background-color:red; color:white; border:none; padding:4px 8px;'>Delete</button>";
                        echo "</form>";

                        echo "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='9'>Error: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
  $.fn.dataTable.ext.pager.three_button = function (page, pages) {
    var numbers = [];
    var buttons = [];
    var current = page;
    var total = pages;

    var start = current - 1;
    var end = current + 1;

    if (start < 0) {
      start = 0;
      end = 2;
    }

    if (end >= total) {
      end = total - 1;
      start = total - 3;
    }

    start = Math.max(start, 0);
    end = Math.min(end, total - 1);

    for (var i = start; i <= end; i++) {
      numbers.push(i);
    }

    buttons.push('previous');
    $.merge(buttons, numbers);
    buttons.push('next');

    return buttons;
  };

  $(document).ready(function () {
    if ($.fn.DataTable.isDataTable('#roomTable')) {
      $('#roomTable').DataTable().clear().destroy();
    }

    $('#roomTable').DataTable({
      pagingType: "three_button", // gunakan custom pager di atas
      pageLength: 10,
      info: true,
      searching: true,
      ordering: true
    });
  });
</script>

<?php include('../partials/footer.php'); ?>
