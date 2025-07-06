<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<?php include('../config/db.php'); ?>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<link rel="stylesheet" href="../assets/css/list-ruangan.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update status manual
    if (isset($_POST['room_id'], $_POST['new_status'])) {
        $room_id = $_POST['room_id'];
        $new_status = $_POST['new_status'];
        $updateStmt = $pdo->prepare("UPDATE rooms 
            SET status = :new_status, manual_override = :new_status 
            WHERE id = :room_id
        ");
        $updateStmt->execute([
            ':new_status' => $new_status,
            ':room_id' => $room_id
        ]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Reset ke otomatis
    if (isset($_POST['reset_override'])) {
        $room_id = $_POST['reset_override'];
        $stmt = $pdo->prepare("UPDATE rooms SET manual_override = NULL WHERE id = :id");
        $stmt->execute([':id' => $room_id]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Hapus ruangan
    if (isset($_POST['delete_room_id'])) {
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
                    $currentDay = date('l');
                    $currentTime = date('H:i:s');
                    $onlineRoomId = 999; // ID ruangan online, bisa kamu sesuaikan

                    $stmt = $pdo->query("
                        SELECT r.*, 
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
                        if ($row['id'] == $onlineRoomId || strtolower($row['code']) === 'online') {
                            continue;
                        }

                        // Tentukan status yang akan ditampilkan
                        if (!is_null($row['manual_override'])) {
                            $status = $row['manual_override'];
                        } else {
                            $status = $row['is_in_use'] ? 'in_use' : 'available';

                            if ($row['status'] !== $status) {
                                $updateStmt = $pdo->prepare("UPDATE rooms SET status = :status WHERE id = :id");
                                $updateStmt->execute([
                                    ':status' => $status,
                                    ':id' => $row['id']
                                ]);
                            }
                        }

                        // Tampilkan data baris
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['code']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['building']) . "</td>";
                        echo "<td>" . ucwords(str_replace('_', ' ', $status)) . "</td>";
                        echo "<td class='aksi-cell'>";

                        // Form Ubah Status Manual
                        echo "<form method='POST' style='display:inline-block; margin-right:5px;'>";
                        echo "<input type='hidden' name='room_id' value='" . $row['id'] . "'>";
                        echo "<select name='new_status' onchange='this.form.submit()'>";
                        echo "<option disabled selected>Edit Status</option>";
                        echo "<option value='available'" . ($status === 'available' ? " disabled" : "") . ">Available</option>";
                        echo "<option value='in_use'" . ($status === 'in_use' ? " disabled" : "") . ">In Use</option>";
                        echo "</select>";
                        echo "</form>";

                        // Form Reset Manual Override
                        if (!is_null($row['manual_override'])) {
                            echo "<form method='POST' style='display:inline-block; margin-right:8px;'>";
                            echo "<input type='hidden' name='reset_override' value='" . $row['id'] . "'>";
                            echo "<button type='submit'>Reset</button>";
                            echo "</form>";
                        }

                        // Form Hapus Ruangan
                        echo "<form method='POST' onsubmit=\"return confirm('Yakin ingin menghapus ruangan ini?');\" style='display:inline-block;'>";
                        echo "<input type='hidden' name='delete_room_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='delete-button' style='background-color:red; color:white;'>Delete</button>";
                        echo "</form>";

                        echo "</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
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
