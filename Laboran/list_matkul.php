<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<?php include('../config/db.php'); ?>
<link rel="stylesheet" href="../assets/css/list_matkul.css">
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
                    <th>ID</th>
                    <th>Room</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Course</th>
                    <th>Lecturer</th>
                    <th>Class</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Ambil data dari tabel courses
                    $stmt = $pdo->query("SELECT * FROM courses");
                    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($courses as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['room_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['day']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['start_time']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['end_time']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['course']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lecturer']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['class']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['semester']) . "</td>";
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

<?php include('../partials/footer.php'); ?>
