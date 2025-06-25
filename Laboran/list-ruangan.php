<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');
?>
<link rel="stylesheet" href="../assets/css/list-ruangan.css">

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update status
    if (isset($_POST['room_id'], $_POST['new_status'])) {
        $room_id = intval($_POST['room_id']);
        $new_status = $_POST['new_status'];

        try {
            $updateStmt = $pdo->prepare("UPDATE rooms SET status = :new_status WHERE id = :room_id");
            $updateStmt->execute([
                ':new_status' => $new_status,
                ':room_id'    => $room_id
            ]);
        } catch (PDOException $e) {
            echo "<script>alert('Gagal memperbarui status: " . $e->getMessage() . "');</script>";
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Delete room
    if (isset($_POST['delete_room_id'])) {
        $delete_id = intval($_POST['delete_room_id']);

        try {
            $deleteStmt = $pdo->prepare("DELETE FROM rooms WHERE id = :id");
            $deleteStmt->execute([':id' => $delete_id]);
        } catch (PDOException $e) {
            echo "<script>alert('Gagal menghapus ruangan: " . $e->getMessage() . "');</script>";
        }

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
                    $stmt = $pdo->query("SELECT * FROM rooms");
                    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rooms as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['code']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['building']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";

                        // Kolom Aksi
                        echo "<td class='aksi-cell'>";

                        // Form Update Status
                        echo "<form method='POST' style='display:inline-block; margin-right:5px;'>";
                        echo "<input type='hidden' name='room_id' value='" . $row['id'] . "'>";
                        echo "<select name='new_status' onchange='this.form.submit()'>";
                        echo "<option value=''>-- Ubah Status --</option>";
                        echo "<option value='available'" . ($row['status'] === 'available' ? " disabled" : "") . ">Available</option>";
                        echo "<option value='in use'" . ($row['status'] === 'in use' ? " disabled" : "") . ">In Use</option>";
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
                    echo "<tr><td colspan='6'>Error mengambil data: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
