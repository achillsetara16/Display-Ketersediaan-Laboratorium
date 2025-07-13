<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');

// BAGIAN UNTUK AMBIL DATA SAJA (DIPANGGIL VIA AJAX)
if (isset($_GET['get_data'])) {
    try {
        $stmt = $pdo->query("
            SELECT 
                u.nik,
                u.nama_lengkap,
                u.prodi,
                r.code AS room_code,
                COALESCE(dp.status, 'not_in_room') AS status
            FROM users u
            LEFT JOIN (
                SELECT user_id, room_id, status
                FROM dosen_presence dp1
                WHERE id IN (
                    SELECT MAX(id)
                    FROM dosen_presence dp2
                    WHERE dp1.user_id = dp2.user_id
                )
            ) dp ON dp.user_id = u.id
            LEFT JOIN rooms r ON dp.room_id = r.id
            WHERE u.role = 'dosen' AND u.id IN (1, 2)
        ");

        $lecturers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lecturers as $row) {
            $status = htmlspecialchars($row['status']);
            $label = $status === 'in_room' ? 'In Room' : 'Not In Room';
            $statusClass = $status === 'in_room' ? 'status-hadir' : 'status-tidak';

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prodi'] ?? '-') . "</td>";
            echo "<td>" . htmlspecialchars($row['room_code'] ?? '-') . "</td>";
            echo "<td class=\"$statusClass\">" . $label . "</td>";
            echo "</tr>";
        }
    } catch (PDOException $e) {
        echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
    }
    exit;
}
?>

<!-- HTML TAMPILAN UTAMA -->
<link rel="stylesheet" href="../assets/css/status-dosen.css">
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
                <!-- Data akan diisi lewat JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<!-- JAVASCRIPT UNTUK REFRESH REAL-TIME -->
<script>
function fetchStatusDosen() {
    fetch(window.location.href + '?get_data=1')
        .then(response => response.text())
        .then(data => {
            document.querySelector('#roomTable tbody').innerHTML = data;
        })
        .catch(error => console.error('Error fetch data:', error));
}

fetchStatusDosen(); // pertama kali
setInterval(fetchStatusDosen, 5000); // refresh setiap 5 detik
</script>