<?php
include '../config/db.php';

if (isset($_GET['get_data'])) {
  try {
    $stmt = $pdo->query("
      SELECT 
          u.id AS room,  
          u.nama_lengkap AS name,
          u.prodi AS department,
          COALESCE(dp.status, 'not_in_room') AS status
      FROM (
          SELECT *
          FROM dosen_presence
          WHERE id IN (
              SELECT MAX(id)
              FROM dosen_presence
              WHERE user_id IN (1, 2)
              GROUP BY user_id
          )
      ) dp
      JOIN users u ON u.id = dp.user_id
      WHERE u.role = 'dosen'
      ORDER BY u.id ASC
    ");

    $lecturers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $statusConfig = [
      "in_room" => ["label" => "🟢 IN ROOM", "stripe" => "#10b981", "badgeClass" => "badge--available"],
      "not_in_room" => ["label" => "🔴 NOT IN ROOM", "stripe" => "#ef4444", "badgeClass" => "badge--unavailable"]
    ];

    foreach ($lecturers as $lec) {
      if (!$lec['name']) continue;
      $status = $lec['status'];
      $cfg = $statusConfig[$status] ?? $statusConfig['not_in_room'];

      echo '<article class="card" style="--stripe:' . $cfg['stripe'] . '">';
      echo '<div class="bg-blur"></div>';
      echo '<div class="card__head">';
      echo '<span class="room">' . htmlspecialchars($lec['room']) . '</span>';
      echo '<span class="badge ' . $cfg['badgeClass'] . '">' . $cfg['label'] . '</span>';
      echo '</div>';
      echo '<div class="card__body">';
      echo '<div class="card__avatar">';
      echo '<div class="avatar-circle">';
      echo '<div class="avatar-inner">';
      echo '<span class="avatar-text">' . strtoupper(substr($lec['name'], 0, 2)) . '</span>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '<div class="card__content">';
      echo '<div class="name">' . htmlspecialchars($lec['name']) . '</div>';
      echo '<div class="dept">' . htmlspecialchars($lec['department']) . '</div>';
      echo '<hr class="card-divider">';
      echo '</div>';
      echo '</div>';
      echo '</article>';
    }
  } catch (PDOException $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
  }
  exit;
}

$page_title = "Lecturer Room Display";
include 'header_display.php';
?>

<main class="main">
  <div class="grid" id="dosenGrid"></div>
</main>

<style>
  body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background: linear-gradient(180deg, #e0e0e9, #1567eb);
    min-height: 100vh;
    overflow-x: hidden;
    padding-bottom: 2rem;
  }

  .main {
    max-width: 1400px;
    margin: 2rem auto;
    padding: 1rem 2rem;
    display: flex;
    justify-content: center;
  }

  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap: 2rem;
    width: 100%;
  }

  .card {
    background: #ffffff;
    border-radius: 1.5rem;
    padding: 2.5rem;
    min-height: 460px;
    box-shadow: 0 25px 40px rgba(0, 0, 0, 0.15);
    position: relative;
    overflow: hidden;
    border-left: 10px solid var(--stripe);
    z-index: 1;
    transition: 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 40px 60px rgba(0, 0, 0, 0.2);
  }

  .bg-blur {
    position: absolute;
    top: -40px;
    right: -40px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, var(--stripe), transparent 70%);
    filter: blur(50px);
    z-index: 0;
    opacity: 0.3;
  }

  .card__head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    z-index: 1;
    position: relative;
  }

  .room {
    background: #3b82f6;
    color: white;
    padding: 1rem 2rem;
    border-radius: 1.2rem;
    font-weight: bold;
    font-size: 1.8rem;
  }

  .badge {
    padding: 0.8rem 1.8rem;
    border-radius: 2rem;
    font-weight: 600;
    font-size: 1.3rem;
    color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
  }

  .badge--available {
    background: #10b981;
    animation: pulse 2s infinite ease-in-out;
  }

  .badge--unavailable {
    background: #ef4444;
  }

  .card__body {
    text-align: center;
    position: relative;
    z-index: 1;
  }

  .card__avatar {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
  }

  .avatar-circle {
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, #60a5fa, #3b82f6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
  }

  .avatar-inner {
    background: white;
    width: 110px;
    height: 110px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
  }

  .avatar-text {
    font-size: 3.4rem;
    font-weight: bold;
    color: #1e3a8a;
  }

  .card__content .name {
    font-size: 2.6rem;
    font-weight: 900;
    margin-top: 1rem;
    color: #0f172a;
  }

  .card__content .dept {
    font-size: 1.8rem;
    font-style: italic;
    color: #334155;
    margin-top: 0.8rem;
  }

  .card-divider {
    margin-top: 2rem;
    border: none;
    height: 3px;
    background: linear-gradient(to right, #3b82f6, #60a5fa);
    border-radius: 2px;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
  }

  @keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.05); opacity: 0.85; }
    100% { transform: scale(1); opacity: 1; }
  }

  @media (max-width: 768px) {
    .grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<script>
  function fetchLecturerStatus() {
    fetch('?get_data=1')
      .then(res => res.text())
      .then(html => {
        document.getElementById('dosenGrid').innerHTML = html;
      })
      .catch(err => console.error("Fetch error:", err));
  }

  fetchLecturerStatus();
  setInterval(fetchLecturerStatus, 5000);
</script>
 