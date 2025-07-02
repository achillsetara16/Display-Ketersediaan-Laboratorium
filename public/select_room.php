<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Room Display - NoLab</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
<<<<<<< HEAD
      --bg: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      --glass: rgba(255, 255, 255, 0.04);
      --border: rgba(255, 255, 255, 0.08);
      --text-main: #ffffff;
      --text-muted: rgba(255, 255, 255, 0.7);
      --accent: #00c6ff;
=======
      --bg: linear-gradient(135deg, #1a1a2e, #16213e, #0f3460);
      --glass: rgba(255, 255, 255, 0.06);
      --border-glass: rgba(255, 255, 255, 0.12);
      --card-gradient: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
      --text-main: #ffffff;
      --text-muted: rgba(255, 255, 255, 0.7);
>>>>>>> 53b23fc1284dd4b452f584714f1de464b09f2294
    }

    html, body {
      margin: 0;
      padding: 0;
      background: var(--bg);
      font-family: 'Inter', sans-serif;
      color: var(--text-main);
      height: 100%;
      overflow-x: hidden;
    }

    .container {
      max-width: 1300px;
      width: 100%;
      margin: 0 auto;
      text-align: center;
      padding: 4rem 2rem 2rem;
    }

    .title {
      font-size: 3rem;
      font-weight: 900;
      margin-bottom: 0.5rem;
    }

    .subtitle {
      color: var(--text-muted);
      font-size: 1.35rem;
      margin-bottom: 3rem;
    }

    .grid-room {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 2rem;
    }

    .card {
      background: var(--glass);
      border: 1px solid var(--border-glass);
      backdrop-filter: blur(25px);
      border-radius: 1.75rem;
      padding: 2.4rem;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      isolation: isolate;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none;
      color: inherit;
    }

    .card:hover {
<<<<<<< HEAD
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
=======
      transform: translateY(-4px);
      box-shadow: 0 25px 50px rgba(118, 75, 162, 0.3);
      background-color: rgba(255, 255, 255, 0.1);
    }

    .icon {
      width: 80px;
      height: 80px;
      border-radius: 1rem;
      margin: 0 auto 1.8rem;
      background: var(--card-gradient);
>>>>>>> 53b23fc1284dd4b452f584714f1de464b09f2294
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(255, 255, 255, 0.15);
    }

    .icon svg {
      width: 44px;
      height: 44px;
      fill: white;
    }

    .room-name {
      font-size: 1.8rem;
      font-weight: 800;
      margin-bottom: 0.4rem;
    }

    .room-sub {
      color: var(--text-muted);
      font-size: 1.15rem;
    }

    .card::before {
      content: '';
      position: absolute;
      top: -30%;
      left: -30%;
      width: 160%;
      height: 160%;
      background: radial-gradient(circle, rgba(255,255,255,0.05), transparent 60%);
      z-index: -1;
      transform: rotate(45deg);
    }
  </style>
</head>
<body>

  <!-- Stylish Back Button (Not Sticky Scroll) -->
  <div class="relative w-full">
    <div class="absolute top-6 left-6 z-10">
      <a href="index.php" class="inline-flex items-center gap-2 text-sm px-4 py-2 rounded-lg border border-white/20 bg-white/10 text-violet-300 backdrop-blur hover:text-white hover:bg-violet-500/20 transition-all shadow-md">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Home
      </a>
    </div>
  </div>

  <div class="container">
    <h1 class="title">Select Room Display</h1>
    <p class="subtitle">Choose a room below to access real-time monitoring details.</p>

    <div class="grid-room">
      <?php
        $rooms = [
          "GU 601" => "display_GU601.php",
          "TA 10.3" => "display_TA103.php",
          "GU 702" => "display_GU702.php",
          "GU 805" => "display_GU805.php",
          "GU 701" => "display_GU701.php",
          "GU 706" => "display_GU706.php",
          "GU 704" => "display_GU704.php",
          "TA 11.5B" => "display_TA115B.php",
          "TA 11.4" => "display_TA114.php",
          "GU 604" => "display_GU604.php",
          "TA 11.3" => "display_TA113.php"
        ];

<<<<<<< HEAD
        foreach ($rooms as $name => $file) {
          echo "
            <a href='{$file}' class='card'>
              <div class='icon'>
                <svg viewBox='0 0 24 24'>
                  <path d='M4 4H20V16H4V4ZM2 18H22V20H2V18ZM6 6V14H18V6H6Z'/>
                </svg>
              </div>
              <div class='room-name'>{$name}</div>
              <div class='room-sub'>Click to view display</div>
            </a>
          ";
        }
=======
      try {
          $stmt = $pdo->query("SELECT code, name FROM rooms ORDER BY code ASC");

          while ($room = $stmt->fetch(PDO::FETCH_ASSOC)):
              $roomCode = $room['code'];
              $roomName = htmlspecialchars($room['name'] ?? $room['code']);
              $link = "display_class.php?room=" . urlencode($roomCode);
      ?>
        <a href="<?= $link ?>" class="card">
          <div class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M2,3V21H4V19H20V21H22V3H20V17H4V3H2Z" />
            </svg>
          </div>
          <div class="room-name"><?= htmlspecialchars($roomCode) ?></div>
          <div class="room-sub">Click to view display</div>
        </a>
      <?php
          endwhile;
      } catch (PDOException $e) {
          echo "<p style='color:red;'>Database error: " . $e->getMessage() . "</p>";
      }
>>>>>>> 53b23fc1284dd4b452f584714f1de464b09f2294
      ?>
    </div>
  </div>
</body>
</html>