<?php
$page_title = "Room Status";
include 'header_display.php';

$currentSchedule = [
  'room'     => 'Room TA 11.4',
  'status'   => 'used',
  'lecturer' => 'Banu Failasuf, S.Tr',
  'course'   => 'Basis Data',
  'time'     => '08:00 – 10:00'
];

$nextSchedule = [
  'room'     => 'Room TA 11.4',
  'status'   => 'next',
  'lecturer' => 'Suwarno, S.S., M.Pd',
  'course'   => 'Bahasa Inggris',
  'time'     => '10:15 – 12:00'
];

function getStatusTitle(string $s): string {
  return [
    'used'      => 'In Use',
    'next'      => 'Next Schedule',
    'available' => 'Available'
  ][$s] ?? 'Unknown';
}
?>

<!-- Google Fonts (Bebas Neue + Urbanist) -->
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  :root {
    --bg-card:#e0ecff; --card-border:#93c5fd;
    --accent:#2563eb; --highlight:#3b82f6;
    --used:#ef4444; --next:#f59e0b; --available:#10b981;
    --info-bg:#c7d2fe;
  }

  .main {
    display:flex;justify-content:center;align-items:start;
    margin-top:2rem;padding:1rem;overflow:hidden;
  }

  .card-container {
    display:flex;gap:2rem;width:95vw;max-width:1500px;
    justify-content:center;flex-wrap:nowrap;
  }

  .card {
    flex:1;max-width:720px;min-width:680px;
    background:var(--bg-card);border-radius:24px;padding:3rem;
    display:flex;flex-direction:column;gap:2rem;
    border:2px solid var(--card-border);
    box-shadow:0 18px 36px rgba(59,130,246,.25);
    transition:.3s ease;position:relative;
    font-family:'Urbanist',sans-serif;
  }
  .card:hover{transform:translateY(-6px);box-shadow:0 26px 48px rgba(59,130,246,.35)}
  .card.used{border-left:14px solid var(--used)}
  .card.next{border-left:14px solid var(--next)}
  .card.available{border-left:14px solid var(--available)}

  .room-label{
    font-family:'Bebas Neue',sans-serif;font-weight:400;
    font-size:2.25rem; /* ↑ slightly larger */
    color:#fff;background:linear-gradient(90deg,var(--highlight),var(--accent));
    padding:1rem 2.5rem;border-radius:18px;margin:0 auto;
    box-shadow:0 6px 16px rgba(0,0,0,.18);text-align:center;letter-spacing:1px;
  }

  .title{
    font-family:'Bebas Neue',sans-serif;font-size:2.7rem; /* ↑ */
    text-transform:uppercase;text-align:center;letter-spacing:2px;margin:.5rem 0;
  }
  .card.used .title{color:var(--used)}
  .card.next .title{color:var(--next)}
  .card.available .title{color:var(--available)}

  .info-container{display:flex;flex-direction:column;gap:1.4rem;flex:1;justify-content:center}
  .info{
    display:flex;align-items:flex-start;gap:1.4rem;
    background:var(--info-bg);padding:1.4rem 2rem;border-radius:14px;
    font-size:1.5rem; /* ↑ */ color:#1e40af;
  }
  .info-icon{font-size:1.9rem;color:var(--highlight);margin-top:.2rem}
  .info-content{display:grid;grid-template-columns:130px 10px 1fr;gap:.4rem;align-items:center}
  .info-label,.info-colon{font-weight:600}
  .info-value{word-wrap:break-word;font-weight:500}

  /* RESPONSIVE */
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

<section class="main">
  <div class="card-container">
    <!-- Current Schedule -->
    <article class="card <?= $currentSchedule['status'] ?>">
      <span class="room-label"><?= htmlspecialchars($currentSchedule['room']) ?></span>
      <h2 class="title"><?= getStatusTitle($currentSchedule['status']) ?></h2>
      <div class="info-container">
        <div class="info"><i class="ph ph-user info-icon"></i><div class="info-content"><span class="info-label">Lecturer</span><span class="info-colon">:</span><span class="info-value"><?= htmlspecialchars($currentSchedule['lecturer']) ?></span></div></div>
        <div class="info"><i class="ph ph-book info-icon"></i><div class="info-content"><span class="info-label">Course</span><span class="info-colon">:</span><span class="info-value"><?= htmlspecialchars($currentSchedule['course']) ?></span></div></div>
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
