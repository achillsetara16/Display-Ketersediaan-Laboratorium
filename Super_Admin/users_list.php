<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');

// Proses hapus user
if (isset($_POST['delete_user_id'])) {
    try {
        $delete_id = $_POST['delete_user_id'];
        $deleteStmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $deleteStmt->execute([':id' => $delete_id]);

        // Redirect untuk mencegah resubmit form
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<link rel="stylesheet" href="../assets/css/list_matkul.css">
<div class="main-content">
    <div class="card">
        <h2>Users List</h2>
        <table id="roomTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Ambil data dari tabel users
                    $stmt = $pdo->query("SELECT * FROM users");
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($users as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        // Kolom Aksi
                        echo "<td class='aksi-cell'>";
                        echo "<form method='POST' onsubmit=\"return confirm('Are you sure want to delete this user?');\" style='display:inline-block;'>";
                        echo "<input type='hidden' name='delete_user_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='delete-button' style='background-color:red; color:white; border:none; padding:4px 8px;'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../partials/footer.php'); ?>
