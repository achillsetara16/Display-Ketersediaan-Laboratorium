<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');

date_default_timezone_set('Asia/Jakarta');

$hari = strtolower(date('l'));
$jam = date('H:i');

$stmt = $pdo->query("SELECT * FROM rooms ORDER BY code ASC");
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM courses WHERE LOWER(day) = :day AND :time BETWEEN start_time AND end_time");
$stmt->execute([
    ':day' => $hari,
    ':time' => $jam
]);
$jadwalAktif = $stmt->fetchAll(PDO::FETCH_ASSOC);

$ruanganDipakai = array_column($jadwalAktif, 'room_id');

if (!empty($ruanganDipakai)) {
    $inQuery = implode(',', array_fill(0, count($ruanganDipakai), '?'));
    $stmt = $pdo->prepare("UPDATE rooms SET status = 'In Use' WHERE code IN ($inQuery)");
    $stmt->execute($ruanganDipakai);
} else {
    $stmt = $pdo->prepare("UPDATE rooms SET status = 'Available'");
    $stmt->execute();
}
?>

<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #ffffff;
  margin: 0;
  padding: 0;
  color: #2c3e50;
}

/* TOPBAR */
.topbar {
  position: fixed;
  top: 0;
  left: 250px;
  right: 0;
  height: 60px;
  background-color: #17252A;
  color: #fff;
  font-size: 1.375rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 30px;
  z-index: 1000;
}

/* SIDEBAR */
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 250px;
  height: 100%;
  background-color: #2B7A78;
  color: #fff;
  padding-top: 20px;
}
.sidebar ul {
  list-style: none;
  padding: 0;
}
.sidebar ul li a {
  display: flex;
  align-items: center;
  padding: 10px 20px;
  color: inherit;
  text-decoration: none;
}
.sidebar ul li a:hover {
  background-color: #3AAFA9;
}
.active {
  background-color: #def2f1;
  color: #17252A !important;
  font-weight: bold;
  border-left: 4px solid #3AAFA9;
}
.sidebar .logo-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80px;
  padding: 60px;
}
.sidebar .logo-container img {
  width: 100%;
  max-width: 120px;
}

/* CONTENT */
.content {
  margin-left: 250px;
  padding-top: 0px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
}

.container {
  display: flex;
  gap: 20px;
  flex-wrap: nowrap;
  align-items: flex-start;
}

/* STATUS CARD */
.status-card {
  background: #fff;
  border-radius: 10px;
  padding: 10px;
  width: 280px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.07);
}
.status-card h3 {
  font-size: 1.2rem;
  margin-bottom: 1rem;
  color: #2980b9;
  border-bottom: 1px solid #ddd;
  padding-bottom: 0.5rem;
}
.daftarRuangan {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.baris-ruangan {
  display: flex;
  align-items: center;
  gap: 6px;
  background: #f4f6f8;
  padding: 10px 12px;
  border-radius: 8px;
  font-size: 0.9rem;
}
.label {
  font-weight: bold;
  color: #34495e;
}
.kode {
  font-weight: bold;
  color: #2c3e50;
}
.status {
  padding: 5px 10px;
  border-radius: 12px;
  font-weight: 600;
  font-size: 0.8rem;
}
.status-merah {
  background-color: #e74c3c;
  color: #fff;
}
.status-hijau {
  background-color: #2ecc71;
  color: #fff;
}

/* TABLE CARD */
.table-card {
  flex: 1;
  background: #fff;
  border-radius: 10px;
  padding: 10px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.07);
}
.table-card h3 {
  font-size: 1.2rem;
  margin-bottom: 1rem;
  color: #2980b9;
  border-bottom: 1px solid #ddd;
  padding-bottom: 0.5rem;
}
.table-wrapper {
  overflow-x: auto;
}
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  padding: 14px 16px;
  text-align: center;
  font-size: 0.95rem;
}
th {
  background-color: #3498db;
  color: #fff;
}
tr:nth-child(even) {
  background-color: #f9f9f9;
}
tr:hover {
  background-color: #ecf0f1;
}

/* FOOTER */
footer {
  text-align: center;
  padding: 20px;
  background-color: #17252A;
  color: #ecf0f1;
  margin-top: 50px;
}

/* RESPONSIVE */
@media (max-width: 900px) {
  .container {
    flex-direction: column;
  }
}
</style>

<div class="content">
  <div class="container">
    
    <!-- STATUS RUANGAN -->
    <div class="card status-card">
      <h3>Status Ruangan</h3>
      <div class="daftarRuangan">
        <?php foreach ($rooms as $room): ?>
          <?php
            $kode = htmlspecialchars($room['code']);
            $status = htmlspecialchars($room['status']);
            $warnaClass = ($status === 'In Use') ? 'status-merah' : 'status-hijau';
          ?>
          <div class='baris-ruangan'>
            <span class='label'>Ruang</span>
            <span class='kode'><?= $kode ?></span>
            <span class='status <?= $warnaClass ?>'><?= $status ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- JADWAL SAAT INI -->
    <div class="card table-card">
      <h3>Jadwal Saat Ini</h3>
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>Ruangan</th>
              <th>Mata Kuliah</th>
              <th>Dosen</th>
              <th>Jam</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($jadwalAktif)): ?>
              <?php foreach ($jadwalAktif as $row): ?>
                <tr>
                  <td><?= htmlspecialchars($row['room_id']) ?></td>
                  <td><?= htmlspecialchars($row['course']) ?></td>
                  <td><?= htmlspecialchars($row['lecturer']) ?></td>
                  <td><?= date('H:i', strtotime($row['start_time'])) ?> - <?= date('H:i', strtotime($row['end_time'])) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="4">Tidak ada jadwal aktif saat ini.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php include('../partials/footer.php'); ?>
