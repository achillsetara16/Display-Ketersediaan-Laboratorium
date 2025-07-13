<?php
$page_title = "Room Status";
include 'header_display.php';
include '../config/db.php'; 

$roomCode = $_GET['room'] ?? null;

if (!$roomCode) {
  echo "<p style='color:red; text-align:center;'>No room selected.</p>";
  exit;
}

date_default_timezone_set('Asia/Jakarta');
$currentTime = date('H:i:s');
$currentDay = strtolower(date('l'));
$currentDate = date('Y-m-d');

// Ambil ID ruangan dari kode
$stmtRoomId = $pdo->prepare("SELECT id FROM rooms WHERE code = ?");
$stmtRoomId->execute([$roomCode]);
$roomId = $stmtRoomId->fetchColumn();

if (!$roomId) {
  echo "<p style='color:red; text-align:center;'>Room code not found in database.</p>";
  exit;
}

// Ambil jadwal saat ini dari database
$stmtCurrent = $pdo->prepare("SELECT course, lecturer, start_time, end_time FROM courses 
  WHERE room_id = ? AND day = ? AND start_time <= ? AND end_time >= ?
  ORDER BY start_time ASC LIMIT 1");
$stmtCurrent->execute([$roomId, $currentDay, $currentTime, $currentTime]);
$rowCurrent = $stmtCurrent->fetch(PDO::FETCH_ASSOC);

// Ambil jadwal berikutnya dari database
$stmtNext = $pdo->prepare("SELECT course, lecturer, start_time, end_time FROM courses 
  WHERE room_id = ? AND day = ? AND start_time > ?
  ORDER BY start_time ASC LIMIT 1");
$stmtNext->execute([$roomId, $currentDay, $currentTime]);
$rowNext = $stmtNext->fetch(PDO::FETCH_ASSOC);

// Ambil data dari API PenRu (gunakan API-Key asli)
$penruData = null;
try {
  $apiUrl = "https://peminjaman.polibatam.ac.id/api-penru/data-peminjaman?koderuangan=" . urlencode($roomCode) . "&tanggal=" . $currentDate;
  $ch = curl_init($apiUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['API-Key: 9a89a3be-1d44-4e81-96a8-585cb0453718']);
  $apiResponse = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($apiResponse, true);

// Tambahan: hanya jika $decoded berupa array
if (is_array($decoded)) {
  foreach ($decoded as $pinjam) {
    // Normalisasi format jam: 08.40 => 08:40
    $start = str_replace('.', ':', $pinjam['start_time']);
    $end   = str_replace('.', ':', $pinjam['end_time']);

    if (
      strtotime($start) <= strtotime($currentTime) &&
      strtotime($end) >= strtotime($currentTime)
    ) {
      $penruData = $pinjam;
      break;
    }
  }

} else {
  // Debug optional
  // echo "<pre>API response invalid:\n" . htmlspecialchars($apiResponse) . "</pre>";
}

} catch (Exception $e) {
  $penruData = null;
}

// Jika ada data dari API PenRu sekarang, override jadwal
if ($penruData) {
  $currentSchedule = [
  'room'     => 'Room ' . strtoupper($roomCode),
  'status'   => 'used',
  'lecturer' => $penruData['nama_mahasiswa'] ?? 'Unknown',
  'course'   => $penruData['jenis_kegiatan'] ?? 'Booked via PenRu',
  'time'     => str_replace('.', ':', $penruData['start_time']) . ' – ' . str_replace('.', ':', $penruData['end_time'])
];

} else {
  $currentSchedule = [
    'room'     => 'Room ' . strtoupper($roomCode),
    'status'   => $rowCurrent ? 'used' : 'available',
    'lecturer' => $rowCurrent['lecturer'] ?? '-',
    'course'   => $rowCurrent['course'] ?? '-',
    'time'     => isset($rowCurrent['start_time'])
      ? date('H:i', strtotime($rowCurrent['start_time'])) . ' – ' . date('H:i', strtotime($rowCurrent['end_time']))
      : '-'
  ];
}

if ($penruData) {
  $labelLecturer = "Borrower";
  $labelCourse = "Activity";
} else {
  $labelLecturer = "Lecturer";
  $labelCourse = "Course";
}


// Next schedule tetap dari database
$nextSchedule = [
  'room'     => 'Room ' . strtoupper($roomCode),
  'status'   => 'next',
  'lecturer' => $rowNext['lecturer'] ?? '-',
  'course'   => $rowNext['course'] ?? '-',
  'time'     => isset($rowNext['start_time'])
    ? date('H:i', strtotime($rowNext['start_time'])) . ' – ' . date('H:i', strtotime($rowNext['end_time']))
    : '-'
];

function getStatusTitle(string $s): string {
  return [
    'used'      => 'In Use',
    'next'      => 'Next Schedule',
    'available' => 'Available'
  ][$s] ?? 'Unknown';
}
?>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Styles tetap sama -->
<style>
  :root {
    --bg-card:#e0ecff; --card-border:#93c5fd;
    --accent:#2563eb; --highlight:#3b82f6;
    --used:#ef4444; --next:#f59e0b; --available:#10b981;
    --info-bg:#c7d2fe;
  }
  .main {
    display:flex;justify-content:center;align-items:start;
    margin-top:2rem;padding:1rem;
  }
  .card-container {
  display: flex;
  justify-content: space-between;
  align-items: stretch; /* ✅ memastikan tinggi kartu rata */
  flex-wrap: wrap;
  width: 100%;
  max-width: 1500px;
  gap: 2rem;
}

.card {
  flex: 1 1 48%;
  background: var(--bg-card);
  border-radius: 24px;
  padding: 3rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* ✅ isi rata vertikal */
  min-height: 460px; /* ✅ atur tinggi minimum kartu */
  border: 2px solid var(--card-border);
  box-shadow: 0 18px 36px rgba(59,130,246,.25);
  transition: .3s ease;
  position: relative;
  font-family: 'Urbanist', sans-serif;
}

  .card:hover{transform:translateY(-6px);box-shadow:0 26px 48px rgba(59,130,246,.35)}
  .card.used{border-left:14px solid var(--used)}
  .card.next{border-left:14px solid var(--next)}
  .card.available{border-left:14px solid var(--available)}
  .room-label{
    font-family:'Bebas Neue',sans-serif;font-weight:400;
    font-size:2.25rem;color:#fff;
    background:linear-gradient(90deg,var(--highlight),var(--accent));
    padding:1rem 2.5rem;border-radius:18px;margin:0 auto;
    box-shadow:0 6px 16px rgba(0,0,0,.18);text-align:center;letter-spacing:1px;
  }
  .title{
    font-family:'Bebas Neue',sans-serif;font-size:2.7rem;
    text-transform:uppercase;text-align:center;letter-spacing:2px;margin:.5rem 0;
  }
  .card.used .title{color:var(--used)}
  .card.next .title{color:var(--next)}
  .card.available .title{color:var(--available)}
  .info-container{display:flex;flex-direction:column;gap:1.4rem;flex:1;justify-content:center}
  .info{
    display:flex;align-items:flex-start;gap:1.4rem;
    background:var(--info-bg);padding:1.4rem 2rem;border-radius:14px;
    font-size:1.5rem;color:#1e40af;
  }
  .info-icon{font-size:1.9rem;color:var(--highlight);margin-top:.2rem}
  .info-content{display:grid;grid-template-columns:130px 10px 1fr;gap:.4rem;align-items:center}
  .info-label,.info-colon{font-weight:600}
  .info-value{word-wrap:break-word;font-weight:500}
  @media(max-width:1400px){
    .card-container{gap:1.5rem}
    .card{min-width:600px;padding:2.5rem}
    .info{font-size:1.3rem}
    .title{font-size:2.2rem}
    .room-label{font-size:1.9rem}
  }
  @media(max-width:1200px){
    .card-container{flex-direction:column;align-items:center}
    .card{width:90%;max-width:800px;min-width:unset}
  }
  @media(max-width:768px){
    .card{padding:2rem}
    .info{font-size:1.1rem}
    .title{font-size:1.6rem}
    .room-label{font-size:1.45rem}
  }
</style>

<!-- HTML -->
<section class="main">
  <div class="card-container">
    <!-- Current Schedule -->
    <article class="card <?= $currentSchedule['status'] ?>">
      <span class="room-label"><?= htmlspecialchars($currentSchedule['room']) ?></span>
      <h2 class="title"><?= getStatusTitle($currentSchedule['status']) ?></h2>
      <div class="info-container">
        <div class="info"><i class="ph ph-user info-icon"></i><div class="info-content"><span class="info-label"><?= htmlspecialchars($labelLecturer) ?></span><span class="info-colon">:</span><span class="info-value"><?= htmlspecialchars($currentSchedule['lecturer']) ?></span></div></div>
        <div class="info"><i class="ph ph-book info-icon"></i><div class="info-content"><span class="info-label"><?= htmlspecialchars($labelCourse) ?></span><span class="info-colon">:</span><span class="info-value"><?= htmlspecialchars($currentSchedule['course']) ?></span></div></div>
        <div class="info"><i class="ph ph-clock info-icon"></i><div class="info-content"><span class="info-label">Time</span><span class="info-colon">:</span><span class="info-value"><?= htmlspecialchars($currentSchedule['time']) ?></span></div></div>
      </div>
    </article>

    <!-- Next Schedule -->
    <article class="card <?= $nextSchedule['status'] ?>">
      <span class="room-label"><?= htmlspecialchars($nextSchedule['room']) ?></span>
      <h2 class="title"><?= getStatusTitle($nextSchedule['status']) ?></h2>
      <div class="info-container">
        <div class="info"><i class="ph ph-user info-icon"></i><div class="info-content"><span class="info-label">Lecturer</span><span class="info-colon">:</span><span class="info-value"><?= htmlspecialchars($nextSchedule['lecturer']) ?></span></div></div>
        <div class="info"><i class="ph ph-book info-icon"></i><div class="info-content"><span class="info-label">Course</span><span class="info-colon">:</span><span class="info-value"><?= htmlspecialchars($nextSchedule['course']) ?></span></div></div>
        <div class="info"><i class="ph ph-clock info-icon"></i><div class="info-content"><span class="info-label">Time</span><span class="info-colon">:</span><span class="info-value"><?= htmlspecialchars($nextSchedule['time']) ?></span></div></div>
      </div>
    </article>
  </div>
</section>
