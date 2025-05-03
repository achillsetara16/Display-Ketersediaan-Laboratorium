<?php 
    // Menyertakan header, sidebar, dan footer
    include('../partials/header.php'); 
    include('../partials/sidebar.php'); 
?>
<link rel="stylesheet" href="../assets/css/status-rooms.css">

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="card">
        <h2>Status Ruangan Saat Ini</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Ruangan</th>
                    <th>Nama Ruangan</th>
                    <th>Gedung</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Status Ruangan dimasukkan dengan PHP -->
                <?php
                // Simulasi data dengan lebih banyak data ruangan
                $statusData = [
                    ['id' => 1, 'kode' => 'R101', 'nama' => 'Lab Komputer', 'gedung' => 'Gedung A', 'status' => 'Available'],
                    ['id' => 2, 'kode' => 'R102', 'nama' => 'Lab Jaringan', 'gedung' => 'Gedung B', 'status' => 'In Use'],
                    ['id' => 3, 'kode' => 'R103', 'nama' => 'Lab IoT', 'gedung' => 'Gedung C', 'status' => 'Available'],
                    ['id' => 4, 'kode' => 'R104', 'nama' => 'Lab Multimedia', 'gedung' => 'Gedung D', 'status' => 'In Use'],
                    ['id' => 5, 'kode' => 'R105', 'nama' => 'Lab Elektronika', 'gedung' => 'Gedung A', 'status' => 'Available'],
                    ['id' => 6, 'kode' => 'R106', 'nama' => 'Lab Otomasi', 'gedung' => 'Gedung B', 'status' => 'In Use'],
                    ['id' => 7, 'kode' => 'R107', 'nama' => 'Lab Embedded System', 'gedung' => 'Gedung C', 'status' => 'Available'],
                    ['id' => 8, 'kode' => 'R108', 'nama' => 'Lab System', 'gedung' => 'Gedung Z', 'status' => 'In Use'],
                    ['id' => 9, 'kode' => 'R109', 'nama' => 'Lab Robotika', 'gedung' => 'Gedung E', 'status' => 'Available'],
                    ['id' => 10, 'kode' => 'R110', 'nama' => 'Lab Pemrograman', 'gedung' => 'Gedung F', 'status' => 'In Use']
                ];
                
                foreach ($statusData as $room) {
                    $statusClass = $room['status'] === 'Available' ? 'status-available' : 'status-inuse';
                    echo "
                    <tr>
                        <td>{$room['id']}</td>
                        <td>{$room['kode']}</td>
                        <td>{$room['nama']}</td>
                        <td>{$room['gedung']}</td>
                        <td class='$statusClass'>{$room['status']}</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php 
    // Menyertakan footer
    include('../partials/footer.php'); 
?>
