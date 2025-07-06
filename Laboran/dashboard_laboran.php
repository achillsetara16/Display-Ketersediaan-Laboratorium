<?php
include('../partials/header.php');
include('../partials/sidebar.php');
include('../config/db.php');

date_default_timezone_set('Asia/Jakarta');

$hari = strtolower(date('l'));
$jam = date('H:i');
$onlineRoomId = 999;

// Ambil semua data ruangan
$stmt = $pdo->query("SELECT * FROM rooms ORDER BY code ASC");
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil jadwal aktif saat ini
$stmt = $pdo->prepare("
    SELECT c.*, r.code AS room_code 
    FROM courses c 
    JOIN rooms r ON c.room_id = r.id 
    WHERE LOWER(c.day) = :day AND :time BETWEEN c.start_time AND c.end_time
");
$stmt->execute([
    ':day' => $hari,
    ':time' => $jam
]);
$jadwalAktif = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil ID ruangan yang sedang digunakan
$ruanganDipakai = array_filter(array_column($jadwalAktif, 'room_id'), function($id) use ($onlineRoomId) {
    return $id != $onlineRoomId;
});

// Reset semua status ke 'available' jika tidak manual override
$stmt = $pdo->query("SELECT id, manual_override FROM rooms WHERE id != $onlineRoomId");
$allRooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($allRooms as $room) {
    if (is_null($room['manual_override'])) {
        $pdo->prepare("UPDATE rooms SET status = 'available' WHERE id = ?")->execute([$room['id']]);
    }
}

// Set status 'in use' untuk ruangan yang sedang dipakai jika tidak manual override
if (!empty($ruanganDipakai)) {
    foreach ($ruanganDipakai as $room_id) {
        $stmt = $pdo->prepare("SELECT manual_override FROM rooms WHERE id = ?");
        $stmt->execute([$room_id]);
        $manual = $stmt->fetchColumn();

        if (is_null($manual)) {
            $pdo->prepare("UPDATE rooms SET status = 'in_use' WHERE id = ?")->execute([$room_id]);
        }
    }
}
?>

<style>


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
      <h3>Room Status</h3>
      <div class="daftarRuangan">
        <?php foreach ($rooms as $room): ?>
          <?php
            if ($room['id'] == 999) continue; // Sembunyikan ruangan Online
            $kode = htmlspecialchars($room['code']);
            $status = htmlspecialchars($room['status']);
            $warnaClass = ($status === 'in_use') ? 'status-merah' : 'status-hijau';
          ?>
          <div class='baris-ruangan'>
            <span class='label'>Room</span>
            <span class='kode'><?= $kode ?></span>
            <span class='status <?= $warnaClass ?>'><?= ucwords(str_replace('_', ' ', $status)) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- JADWAL SAAT INI -->
    <div class="card table-card">
      <h3>Current Schedule</h3>
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>Room</th>
              <th>Course</th>
              <th>Lecturer</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($jadwalAktif)): ?>
              <?php foreach ($jadwalAktif as $row): ?>
                <tr>
                  <td><?= htmlspecialchars($row['room_code']) ?></td>
                  <td><?= htmlspecialchars($row['course']) ?></td>
                  <td><?= htmlspecialchars($row['lecturer']) ?></td>
                  <td><?= date('H:i', strtotime($row['start_time'])) ?> - <?= date('H:i', strtotime($row['end_time'])) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="4">There is no active schedule at the moment.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php include('../partials/footer.php'); ?>
