<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Select Room Display - NoLab</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --bg: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      --glass: rgba(255, 255, 255, 0.04);
      --border: rgba(255, 255, 255, 0.08);
      --text-main: #ffffff;
      --text-muted: rgba(255, 255, 255, 0.7);
      --accent: #00c6ff;
    }

    html, body {
      margin: 0;
      padding: 0;
      background: var(--bg);
      font-family: 'Segoe UI', Tahoma, sans-serif;
      color: var(--text-main);
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 4rem 1.5rem;
      text-align: center;
    }

    .title {
      font-size: 2.8rem;
      font-weight: 800;
      margin-bottom: 0.5rem;
    }

    .subtitle {
      font-size: 1.2rem;
      color: var(--text-muted);
      margin-bottom: 3rem;
    }

    .grid-room {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
    }

    .card {
      background: var(--glass);
      border: 1px solid var(--border);
      border-radius: 1.25rem;
      padding: 2rem;
      text-align: center;
      transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.4s ease;
      backdrop-filter: blur(18px);
      text-decoration: none;
      color: inherit;
    }

    .card:hover {
      transform: translateY(-6px) scale(1.02);
      box-shadow: 0 18px 32px rgba(0, 0, 0, 0.3);
      background-color: rgba(255, 255, 255, 0.06);
    }

    .icon {
      width: 64px;
      height: 64px;
      margin: 0 auto 1.2rem;
      background: linear-gradient(45deg, #00c6ff,rgb(20, 133, 240));
      border-radius: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease;
      box-shadow: 0 6px 18px rgba(0, 114, 255, 0.4);
    }

    .card:hover .icon {
      transform: scale(1.1) rotate(4deg);
    }

    .icon svg {
      width: 36px;
      height: 36px;
      fill: white;
    }

    .room-name {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 0.3rem;
    }

    .room-sub {
      font-size: 1rem;
      color: var(--text-muted);
    }

    .back-button {
      position: absolute;
      top: 1.5rem;
      left: 1.5rem;
    }

    .back-button a {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.6rem 1rem;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255,255,255,0.12);
      color: var(--accent);
      border-radius: 0.5rem;
      font-size: 0.95rem;
      transition: 0.2s;
      text-decoration: none;
    }

    .back-button a:hover {
      background: rgba(0, 198, 255, 0.1);
      color: white;
    }

    .back-button svg {
      width: 18px;
      height: 18px;
    }
  </style>
</head>

<body>

  <div class="back-button">
    <a href="index.php">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Home
    </a>
  </div>

  <div class="container">
    <h1 class="title">Select Room Display</h1>
    <p class="subtitle">Choose a room below to access real-time monitoring details.</p>
      <?php
        include '../config/db.php';   // $pdo sudah terkoneksi

        // Ambil semua room code yang ingin ditampilkan
        $stmt = $pdo->query("SELECT code, name FROM rooms ORDER BY code ASC");
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="grid-room">
          <?php foreach ($rooms as $room): ?>
            <a href="display_class.php?room=<?= urlencode($room['code']) ?>" class="card">
              <div class="icon">
                <svg viewBox="0 0 24 24">
                  <path d="M4 4H20V16H4V4ZM2 18H22V20H2V18ZM6 6V14H18V6H6Z"/>
                </svg>
              </div>
              <div class="room-name"><?= htmlspecialchars($room['code']) ?></div>
              <div class="room-sub">Click to view display</div>
            </a>
          <?php endforeach; ?>
    </div>
  </div>

</body>
</html>