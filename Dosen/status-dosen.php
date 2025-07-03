<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<?php include('../config/db.php'); ?>
<link rel="stylesheet" href="../assets/css/status-dosen.css">
<script type="module" src="../assets/js/status-dosen.js"></script>

<div class="main-content">
    <div class="card">
        <h2>Status Lecturer</h2>
        <table id="roomTable">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Name</th>
                    <th>Prodi</th>
                    <th>Room</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    <?php
    try {
        $stmt = $pdo->query("SELECT 
                users.nik,
                users.nama_lengkap,
                users.prodi,
                rooms.code AS room_code,
                dosen_presence.status
            FROM dosen_presence
            JOIN users ON dosen_presence.user_id = users.id
            JOIN rooms ON dosen_presence.room_id = rooms.id
            ORDER BY dosen_presence.time_in DESC
        ");

        $lecturers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lecturers as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name_lengkap']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prodi']) . "</td>";
            echo "<td>" . htmlspecialchars($row['room_code']) . "</td>";
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
    }
    ?>
</tbody>
