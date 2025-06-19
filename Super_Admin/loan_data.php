<?php
include('../partials/header.php');
include('../partials/sidebar.php');
?>
<link rel="stylesheet" href="../assets/css/list_matkul.css">

<?php
// Ambil tanggal hari ini
$tanggal = date('Y-m-d');
$koderuangan = 'A101'; // Bisa dibuat dynamic via form jika diperlukan

// URL API
$url = "https://peminjaman.polibatam.ac.id/api-penru/data-peminjaman?koderuangan=$koderuangan&tanggal=$tanggal";

// Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "API-Key: 9a89a3be-1d44-4e81-96a8-585cb0453718"
]);

$response = curl_exec($ch);
curl_close($ch);

// Konversi JSON ke array
$data_peminjaman = json_decode($response, true);
?>

<div class="main-content">
    <div class="card">
        <h2>Data Peminjaman Ruangan (<?= htmlspecialchars($koderuangan) ?> - <?= htmlspecialchars($tanggal) ?>)</h2>
        <table id="roomTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Ruangan</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($data_peminjaman && is_array($data_peminjaman)) {
                    $no = 1;
                    foreach ($data_peminjaman as $row) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>" . htmlspecialchars($row['ruangan'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['hari'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['jam_mulai'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['jam_selesai'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['mata_kuliah'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['dosen'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['kelas'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['semester'] ?? '-') . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada data peminjaman untuk hari ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../partials/footer.php'); ?>
