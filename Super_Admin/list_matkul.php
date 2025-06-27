<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<?php include('../config/db.php'); ?>
<link rel="stylesheet" href="../assets/css/list_matkul.css">

<?php 
// Handle Delete Course
if (isset($_POST['delete_room_id'])) {
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

       <?php 
        // SETUP FILTER, PAGINATION
        $search = $_GET['search'] ?? '';
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // HITUNG TOTAL DATA (untuk pagination)
        $totalStmt = $pdo->prepare("
            SELECT COUNT(*) FROM courses 
            WHERE 
                id LIKE :search OR
                room_id LIKE :search OR
                day LIKE :search OR
                start_time LIKE :search OR
                end_time LIKE :search OR
                course LIKE :search OR
                lecturer LIKE :search OR
                class LIKE :search OR
                semester LIKE :search
        ");
        $totalStmt->execute([':search' => "%$search%"]);
        $totalRows = $totalStmt->fetchColumn();
        $totalPages = ceil($totalRows / $limit);

        // AMBIL DATA TAMPILAN
        $dataStmt = $pdo->prepare("
            SELECT * FROM courses 
            WHERE 
                id LIKE :search OR
                room_id LIKE :search OR
                day LIKE :search OR
                start_time LIKE :search OR
                end_time LIKE :search OR
                course LIKE :search OR
                lecturer LIKE :search OR
                class LIKE :search OR
                semester LIKE :search
            LIMIT :limit OFFSET :offset
        ");
        $dataStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $dataStmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $dataStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $dataStmt->execute();
        $courses = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

       <!-- Entries Form -->
        <form method="GET" class="entries-form">
            <div class="entries-control">
                <select name="limit" id="limit" onchange="this.form.submit()">
                    <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10</option>
                    <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                </select>Entries Per Page
            </div>
            <div class="search-control">
        <input type="text" name="search" id="searchInput" value="<?= htmlspecialchars($search) ?>" placeholder="Search">
    </div>
        </form>
        <!-- TABEL -->
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
                        echo "<td class='aksi-cell'>";
                        echo "<form method='POST' onsubmit=\"return confirm('Are you sure want to delete this?');\" style='display:inline-block;'>";
                        echo "<input type='hidden' name='delete_room_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='delete-button' style='background-color:red; color:white; border:none; padding:4px 8px;'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    if (count($courses) === 0) {
                        echo "<tr><td colspan='10'>No data found.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='10'>Error: " . $e->getMessage() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
       <!-- PAGINATION -->
        <div class="pagination" style="margin-top: 15px; text-align: right;">
            <?php if ($page > 1): ?>
                <a href="?search=<?= urlencode($search) ?>&limit=<?= $limit ?>&page=<?= $page - 1 ?>">&lt;</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?search=<?= urlencode($search) ?>&limit=<?= $limit ?>&page=<?= $i ?>"
                class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?search=<?= urlencode($search) ?>&limit=<?= $limit ?>&page=<?= $page + 1 ?>">&gt;</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    const searchInput = document.getElementById('searchInput');
    const form = document.getElementById('filterForm');

    let timer;
    searchInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            form.submit(); // kirim otomatis setelah ngetik berhenti
        }, 500); // delay 500ms supaya tidak terlalu cepat
    });
</script>

<?php include('../partials/footer.php'); ?>
