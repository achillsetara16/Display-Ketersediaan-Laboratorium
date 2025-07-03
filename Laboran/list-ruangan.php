<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<?php include('../config/db.php'); ?>
<link rel="stylesheet" href="../assets/css/list-ruangan.css">
<!-- jQuery (wajib) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['room_id'], $_POST['new_status'])) {
        // Handle Update Status
        $room_id = $_POST['room_id'];
        $new_status = $_POST['new_status'];
        $updateStmt = $pdo->prepare("UPDATE rooms SET status = :new_status WHERE id = :room_id");
        $updateStmt->execute([
            ':new_status' => $new_status,
            ':room_id' => $room_id
        ]);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['delete_room_id'])) {
        // Handle Delete Room
        $delete_id = $_POST['delete_room_id'];
        $deleteStmt = $pdo->prepare("DELETE FROM rooms WHERE id = :id");
        $deleteStmt->execute([':id' => $delete_id]);

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<div class="main-content">
    <div class="card">
        <h2>Rooms</h2>
        <table id="roomTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Building</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                   $currentDay = date('l'); // contoh: Monday
                   $currentTime = date('H:i:s');

                   $stmt = $pdo->query(
                        "SELECT r.*, 
                        EXISTS (
                        SELECT 1 FROM courses c
                        WHERE c.room_id = r.id
                        AND c.day = '$currentDay'
                        AND '$currentTime' BETWEEN c.start_time AND c.end_time
                        ) AS is_in_use
                            FROM rooms r
                        ");
                    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rooms as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['code']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['building']) . "</td>";
                        $status = $row['is_in_use'] ? 'in use' : 'available';
                        echo "<td>" . $status . "</td>";


                        // Kolom Aksi
                        echo "<td class='aksi-cell'>";

                        // Form Update Status
                        echo "<form method='POST' style='display:inline-block; margin-right:5px;'>";
                        echo "<input type='hidden' name='room_id' value='" . $row['id'] . "'>";
                        echo "<select name='new_status' onchange='this.form.submit()'>";
                        echo "<option disabled selected>Edit Status</option>";
                        echo "<option value='available'" . ($status === 'available' ? " disabled" : "") . ">Available</option>";
                        echo "<option value='in use'" . ($status === 'in use' ? " disabled" : "") . ">In Use</option>";
                        echo "</select>";
                        echo "</form>";

                        // Form Delete Room
                        echo "<form method='POST' onsubmit=\"return confirm('Yakin ingin menghapus ruangan ini?');\" style='display:inline-block;'>";
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
  $(document).ready(function() {
    $('#roomTable').DataTable({
      paging: true,
      searching: true,
      ordering: true,
      info: true
    });
  });
  
</script>
