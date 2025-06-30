<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');

date_default_timezone_set('Asia/Jakarta');

// Ambil hari dan jam sekarang
$hari = strtolower(date('l')); // misal: saturday
$jam = date('H:i');

// Ambil semua ruangan
$stmt = $pdo->query("SELECT * FROM rooms ORDER BY code ASC");
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil semua jadwal aktif saat ini
$stmt = $pdo->prepare("SELECT * FROM courses WHERE LOWER(day) = :day AND :time BETWEEN start_time AND end_time");
$stmt->execute([
    ':day' => $hari,
    ':time' => $jam
]);
$jadwalAktif = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Buat array room_id yang sedang dipakai
$ruanganDipakai = array_column($jadwalAktif, 'room_id');

// Update ruangan yang sedang dipakai jadi 'In Use'
if (!empty($ruanganDipakai)) {
    $inQuery = implode(',', array_fill(0, count($ruanganDipakai), '?'));
    $stmt = $pdo->prepare("UPDATE rooms SET status = 'In Use' WHERE code IN ($inQuery)");
    $stmt->execute($ruanganDipakai);
} else {
    // Kalau tidak ada jadwal aktif, semua ruangan dikembalikan ke Available
    $stmt = $pdo->prepare("UPDATE rooms SET status = 'Available'");
    $stmt->execute();
}
?>
<link rel="stylesheet" href="../assets/css/dashboard.css">
<div class="content">
    <div class="container">

        <!-- STATUS RUANGAN -->
        <div class="card">
            <h3>Status Ruangan</h3>
            <div class="daftarRuangan">
                <?php
                foreach ($rooms as $room) {
                    $kode = htmlspecialchars($room['code']);
                    $status = htmlspecialchars($room['status']);
                    $warnaClass = ($status === 'In Use') ? 'status-merah' : 'status-hijau';
                    echo "<div class='baris-ruangan'><span class='label'>Ruang</span><span class='kode'>$kode</span><span class='status $warnaClass'>$status</span></div>";
                }
                ?>
            </div>
        </div>

        <!-- JADWAL SAAT INI -->
        <div class="card table-card">
            <h3>Jadwal Saat Ini</h3>
            <table id="jadwalTable">
                <thead>
                    <tr>
                        <th>Ruangan</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($jadwalAktif)) {
                        foreach ($jadwalAktif as $row) {
                            $start = date('H:i', strtotime($row['start_time']));
                            $end = date('H:i', strtotime($row['end_time']));
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['room_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['course']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['lecturer']) . "</td>";
                            echo "<td>$start - $end</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada jadwal aktif saat ini.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- STATISTIK -->
        <div class="card">
            <h3>Statistik Penggunaan</h3>
            <canvas id="ruangChart" height="200"></canvas>
        </div>
    </div>
</div>
<?php include('../partials/footer.php'); ?>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
// Hitung jumlah ruangan berdasarkan status
$stmt = $pdo->query("SELECT status, COUNT(*) as jumlah FROM rooms GROUP BY status");
$statusData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

$inUse = isset($statusData['In Use']) ? (int)$statusData['In Use'] : 0;
$available = isset($statusData['Available']) ? (int)$statusData['Available'] : 0;

$labels = json_encode(["In Use", "Available"]);
$data = json_encode([$inUse, $available]);
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('ruangChart').getContext('2d');

    const labels = <?= $labels ?>;
    const data = <?= $data ?>;
    const total = data.reduce((a, b) => a + b, 0);
    const percentages = data.map(v => ((v / total) * 100).toFixed(1) + '%');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#ff4d4d', '#28a745'],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const percent = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} ruangan (${percent}%)`;
                        }
                    }
                }
            }
        },
        plugins: [{
            id: 'drawPercentInSlice',
            afterDatasetDraw(chart, args, options) {
                const {ctx, chartArea: {top, bottom, left, right}} = chart;
                const meta = chart.getDatasetMeta(0);

                meta.data.forEach((element, index) => {
                    const {x, y} = element.tooltipPosition();
                    ctx.save();
                    ctx.fillStyle = "#fff";
                    ctx.font = "bold 14px sans-serif";
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";
                    ctx.fillText(percentages[index], x, y);
                    ctx.restore();
                });
            }
        }]
    });
});
</script>
