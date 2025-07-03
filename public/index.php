<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NoLab - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
       background: linear-gradient(135deg, #2d1b69 0%, #11998e 100%);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .hero h1 {
      font-size: 3.5rem;
      font-weight: 800;
      color: #ffffff;
      text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
      margin-bottom: 1rem;
    }

    .hero .subtitle {
      font-size: 1.3rem;
      color: #d1d5db;
      margin-bottom: 3rem;
      max-width: 600px;
      margin: 0 auto 3rem auto;
      line-height: 1.6;
    }

    .section-title {
      text-align: center;
      font-size: 2.5rem;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 1rem;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .section-subtitle {
      text-align: center;
      color: rgba(255, 255, 255, 0.65);
      margin-bottom: 3rem;
      font-size: 1.1rem;
    }

    .menu-section {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 1rem;
    }

    .menu-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 2rem;
      margin-bottom: 4rem;
    }

    .menu-card {
      width: 100%;
      max-width: 450px;
      background: rgba(255, 255, 255, 0.04);
      backdrop-filter: blur(18px);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 20px;
      padding: 2.5rem;
      cursor: pointer;
      transition: 0.3s ease-in-out;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      position: relative;
      text-align: center;
    }

    .menu-card:hover {
      transform: scale(1.03);
      background: rgba(255, 255, 255, 0.07);
      border-color: rgba(0, 255, 255, 0.2);
      box-shadow: 0 12px 40px rgba(0, 255, 255, 0.2);
    }

    .menu-icon {
      width: 80px;
      height: 80px;
      margin: 0 auto 1.5rem auto;
      background: linear-gradient(45deg, #00c6ff, #0072ff);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease;
    }

    .menu-card:hover .menu-icon {
      transform: scale(1.1) rotate(5deg);
    }

    .menu-icon svg {
      width: 40px;
      height: 40px;
      fill: white;
    }

    .menu-title {
      font-size: 1.8rem;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 1rem;
    }

    .menu-description {
      font-size: 1rem;
      color: rgba(255, 255, 255, 0.85);
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    .menu-features {
      list-style: none;
      margin-bottom: 2rem;
      padding: 0;
    }

    .menu-features li {
      color: rgba(255, 255, 255, 0.75);
      margin-bottom: 0.5rem;
      padding-left: 1.5rem;
      position: relative;
      text-align: left;
    }

    .menu-features li::before {
      content: '✓';
      position: absolute;
      left: 0;
      color: #00ffcc;
      font-weight: bold;
    }

    .menu-stats {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      padding: 1rem;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
    }

    .menu-stat {
      text-align: center;
      flex: 1;
    }

    .menu-stat:not(:last-child) {
      border-right: 1px solid rgba(255, 255, 255, 0.15);
    }

    .menu-stat-number {
      font-size: 1.5rem;
      font-weight: 700;
      color: #ffffff;
      text-shadow: 0 1px 3px rgba(0, 255, 255, 0.3);
    }

    .menu-stat-label {
      font-size: 0.9rem;
      color: rgba(255, 255, 255, 0.6);
      margin-top: 0.3rem;
    }

    .menu-button {
      width: 100%;
      padding: 1rem;
      background: linear-gradient(90deg, #00c6ff, #0072ff);
      color: white;
      font-weight: 600;
      font-size: 1.1rem;
      border: none;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      transition: 0.3s ease;
    }

    .menu-button:hover {
      background: linear-gradient(90deg, #0072ff, #00c6ff);
      box-shadow: 0 8px 25px rgba(0, 198, 255, 0.5);
    }
  </style>

  <?php
  include('../config/db.php');
  $totalStmt = $pdo->query("SELECT COUNT(*) FROM rooms");
  $totalRooms = $totalStmt->fetchColumn();
  $availableStmt = $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'Available'");
  $availableRooms = $availableStmt->fetchColumn();
  $inUseStmt = $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'In Use'");
  $inUseRooms = $inUseStmt->fetchColumn();
  ?>
</head>

<body>
  <?php include 'navbar.php'; ?>

  <main class="flex-grow pt-40 text-center">
    <section class="hero">
      <h1>NoLab</h1>
      <p class="subtitle">
        Real-time laboratory availability monitoring system. Select the type of display you want to view to get the latest room status information.
      </p>
    </section>

    <section class="menu-section">
      <h2 class="section-title">Select Display Type</h2>
      <p class="section-subtitle">Click one of the options below to view the current laboratory availability status</p>

      <div class="menu-grid">
        <!-- Classroom Card -->
        <div class="menu-card" onclick="navigateToDisplay('classroom')">
          <div class="menu-icon">
            <svg viewBox="0 0 24 24">
              <path d="M2,3V21H4V19H20V21H22V3H20V17H4V3H2M18,5V15H6V5H18M8,7V9H10V7H8M12,7V9H14V7H12M16,7V9H18V7H16M8,11V13H10V11H8M12,11V13H14V11H12M16,11V13H18V11H16Z" />
            </svg>
          </div>
          <h3 class="menu-title">Classroom Display</h3>
          <p class="menu-description">
            Monitoring the availability of classrooms, computer laboratories, practical rooms, and other learning facilities.
          </p>
          <ul class="menu-features">
            <li>Computer & Multimedia Labs</li>
            <li>Practicum Rooms</li>
            <li>Regular Classrooms</li>
            <li>Studios & Workshops</li>
          </ul>
          <div class="menu-stats">
            <div class="menu-stat">
              <div class="menu-stat-number">12</div>
              <div class="menu-stat-label">Total Rooms</div>
            </div>
            <div class="menu-stat">
              <div class="menu-stat-number">0</div>
              <div class="menu-stat-label">Available</div>
            </div>
            <div class="menu-stat">
              <div class="menu-stat-number">1</div>
              <div class="menu-stat-label">In Use</div>
            </div>
          </div>
          <button class="menu-button" onclick="window.location.href='select_room.php'">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M8,5.14V19.14L19,12.14L8,5.14Z" />
            </svg>
            Select Room Display
          </button>
        </div>

        <!-- Faculty Card -->
        <div class="menu-card" onclick="navigateToDisplay('faculty')">
          <div class="menu-icon">
            <svg viewBox="0 0 24 24">
              <path d="M12,3L1,9L12,15L21,10.09V17H23V9M5,13.18V17.18L12,21L19,17.18V13.18L12,17L5,13.18Z" />
            </svg>
          </div>
          <h3 class="menu-title">Lecturer Room Display</h3>
          <p class="menu-description">
            Monitoring lecturer presence in individual offices, meeting rooms, consultation spaces, and academic administration areas.
          </p>
          <ul class="menu-features">
            <li>Individual Lecturer Offices</li>
            <li>Meeting & Conference Rooms</li>
            <li>Consultation Rooms</li>
            <li>Academic Administration Spaces</li>
          </ul>
          <div class="menu-stats">
            <div class="menu-stat">
              <div class="menu-stat-number">12</div>
              <div class="menu-stat-label">Total Rooms</div>
            </div>
            <div class="menu-stat">
              <div class="menu-stat-number">9</div>
              <div class="menu-stat-label">Available</div>
            </div>
            <div class="menu-stat">
              <div class="menu-stat-number">2</div>
              <div class="menu-stat-label">In Use</div>
            </div>
          </div>
          <button class="menu-button" onclick="window.location.href='display_dosen.php'">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M8,5.14V19.14L19,12.14L8,5.14Z" />
            </svg>
            View Room Display
          </button>
        </div>
      </div>
    </section>
  </main>

  <?php include 'footer.php'; ?>
</body>

</html>