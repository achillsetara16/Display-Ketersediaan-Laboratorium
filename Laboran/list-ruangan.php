<?php include('../partials/header.php'); ?>
<?php include('../partials/sidebar.php'); ?>
<link rel="stylesheet" href="../assets/css/list-ruangan.css">


<div class="main-content">
    <div class="card">
        <h2>Daftar Ruangan</h2>
        <table id="roomTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Building</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dataRuangan = [
                    ['id' => 1, 'kode_ruangan' => 'R101', 'nama_ruangan' => 'Lab Komputer', 'building' => 'Gedung A'],
                    ['id' => 2, 'kode_ruangan' => 'R102', 'nama_ruangan' => 'Lab Jaringan', 'building' => 'Gedung B'],
                    ['id' => 3, 'kode_ruangan' => 'R103', 'nama_ruangan' => 'Lab IoT', 'building' => 'Gedung C'],
                    ['id' => 4, 'kode_ruangan' => 'R104', 'nama_ruangan' => 'Lab Mekatronika', 'building' => 'Gedung D'],
                    ['id' => 5, 'kode_ruangan' => 'R105', 'nama_ruangan' => 'Lab Elektronika', 'building' => 'Gedung E'],
                    ['id' => 6, 'kode_ruangan' => 'R106', 'nama_ruangan' => 'Lab Kimia', 'building' => 'Gedung F'],
                    ['id' => 7, 'kode_ruangan' => 'R107', 'nama_ruangan' => 'Lab Fisika', 'building' => 'Gedung G'],
                    ['id' => 8, 'kode_ruangan' => 'R108', 'nama_ruangan' => 'Lab Biologi', 'building' => 'Gedung H'],
                    ['id' => 9, 'kode_ruangan' => 'R109', 'nama_ruangan' => 'Lab Multimedia', 'building' => 'Gedung I'],
                    ['id' => 10, 'kode_ruangan' => 'R110', 'nama_ruangan' => 'Lab Desain Grafis', 'building' => 'Gedung J']
                ];

                foreach ($dataRuangan as $room) {
                    echo "<tr>
                  <td>{$room['id']}</td>
                  <td>{$room['kode_ruangan']}</td>
                  <td>{$room['nama_ruangan']}</td>
                  <td>{$room['building']}</td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Footer -->
<?php include('../partials/footer.php'); ?>