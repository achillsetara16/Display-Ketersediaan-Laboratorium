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
/* RESET & DASAR */
*, *::before, *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
body {
  font-family: 'Poppins', sans-serif;
  background-color: #ecf0f1;
  color: #2c3e50;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
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
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}
.sidebar ul {
  list-style: none;
}
.sidebar ul li a {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 20px;
  color: inherit;
  text-decoration: none;
  transition: background-color 0.25s, color 0.25s;
}
.sidebar ul li a:hover {
  background-color: #3AAFA9;
  color: #ffffff;
}
.active {
  background-color: #def2f1;
  color: #17252A !important;
  font-weight: 700;
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
  height: auto;
  max-width: 120px;
  max-height: 120px;
  object-fit: contain;
}
.logo-divider {
  height: 2px;
  background-color: #ddd;
  margin: 20px;
}

/* KONTEN UTAMA */
.content {
  margin: 60px 0 0 250px;
  padding: 1rem;
  flex-grow: 1;
  overflow-x: auto;
}
.container {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}
.card {
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  padding: 20px;
  flex: 1;
  min-width: 300px;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
}
.card h3 {
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  font-size: 1.4rem;
  color: #5dade2;
  border-bottom: 2px solid #ddd;
}
.status-card {
  flex: 0 0 320px;
}
.table-card {
  flex: 1;
}
.table-wrapper {
  overflow-x: auto;
}

/* STATUS BADGE */
.status {
  display: inline-block;
  padding: 4px 8px;
  border-radius: 12px;
  font-size: 0.95rem;
  font-weight: 700;
  text-transform: capitalize;
}
.status-merah {
  background: #e74c3c;
  color: #fff;
}
.status-hijau {
  background: #27ae60;
  color: #fff;
}
.daftarRuangan {
  display: flex;
  flex-direction: column;
  gap: 10px;
  font-family: 'Segoe UI', sans-serif;
  padding-left: 0.25rem;
}
.baris-ruangan {
  display: flex;
  gap: 0.25rem;
  margin-bottom: 6px;
  font-size: 16px;
  align-items: center;
}
.label {
  font-weight: bold;
  min-width: 20px;
}
.kode {
  font-weight: bold;
  min-width: 80px;
}

/* TABEL */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1.2rem;
  background: #fff;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
}
th, td {
  padding: 14px 16px;
  text-align: center;
}
th {
  background: #2980b9;
  color: #fff;
  font-weight: 700;
}
tr:nth-child(even) {
  background-color: #f9f9f9;
}
tr:hover {
  background-color: #eef6ff;
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
