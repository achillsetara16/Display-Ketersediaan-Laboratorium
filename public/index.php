<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #2d1b69 0%, #11998e 100%);
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            animation: gradientShift 3s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(102, 126, 234, 0.3);
            letter-spacing: -2px;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .hero .subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

         /* Menu Cards Section */
        .menu-section {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #ffffff;
        }

        .section-subtitle {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .menu-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            transition: left 0.6s;
        }

        .menu-card:hover::before {
            left: 100%;
        }

        .menu-card:hover {
            transform: translateY(-10px);
            border-color: rgba(102, 126, 234, 0.5);
            box-shadow: 0 25px 50px rgba(102, 126, 234, 0.2);
            background: rgba(255, 255, 255, 0.1);
        }

        .menu-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
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
            margin-bottom: 1rem;
            color: #ffffff;
        }

        .menu-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .menu-features {
            list-style: none;
            margin-bottom: 2rem;
        }

        .menu-features li {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.5rem;
            padding-left: 1.5rem;
            position: relative;
        }

        .menu-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #48bb78;
            font-weight: bold;
        }

        .menu-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
        }

        .menu-stat {
            text-align: center;
        }

        .menu-stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .menu-stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 0.25rem;
        }

        .menu-button {
            width: 100%;
            padding: 1rem 2rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .menu-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
    </style>
    <?php
        include('../config/db.php'); // koneksi database

        // Query jumlah total ruangan
        $totalStmt = $pdo->query("SELECT COUNT(*) FROM rooms");
        $totalRooms = $totalStmt->fetchColumn();

        // Query jumlah ruangan available
        $availableStmt = $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'Available'");
        $availableRooms = $availableStmt->fetchColumn();

        // Query jumlah ruangan in use
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

        <!-- Menu Selection -->
    <section class="menu-section">
        <h2 class="section-title">Select Display Type</h2>
        <p class="section-subtitle">Click one of the options below to view the current laboratory availability status</p>

        <div class="menu-grid">
            <!-- Classroom Display Card -->
            <div class="menu-card" onclick="navigateToDisplay('classroom')">
                <div class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M2,3V21H4V19H20V21H22V3H20V17H4V3H2M18,5V15H6V5H18M8,7V9H10V7H8M12,7V9H14V7H12M16,7V9H18V7H16M8,11V13H10V11H8M12,11V13H14V11H12M16,11V13H18V11H16Z"/>
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
                        <div class="menu-stat-number" id="classroomTotal"><?= $totalRooms ?></div>
                        <div class="menu-stat-label">Total Rooms</div>
                    </div>
                    <div class="menu-stat">
                        <div class="menu-stat-number" id="classroomAvailable"><?= $availableRooms ?></div>
                        <div class="menu-stat-label">Available</div>
                    </div>
                    <div class="menu-stat">
                        <div class="menu-stat-number" id="classroomOccupied"><?= $inUseRooms ?></div>
                        <div class="menu-stat-label">In Use</div>
                    </div>
                </div>

                <button class="menu-button" onclick="window.location.href='/display/classroom'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8,5.14V19.14L19,12.14L8,5.14Z"/>
                    </svg>
                     View Classroom Display
                </button>
            </div>

            <!-- Faculty Display Card -->
            <div class="menu-card" onclick="navigateToDisplay('faculty')">
                <div class="menu-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12,3L1,9L12,15L21,10.09V17H23V9M5,13.18V17.18L12,21L19,17.18V13.18L12,17L5,13.18Z"/>
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
                        <div class="menu-stat-number" id="facultyTotal">12</div>
                        <div class="menu-stat-label">Total Rooms</div>
                    </div>
                    <div class="menu-stat">
                        <div class="menu-stat-number" id="facultyAvailable">9</div>
                        <div class="menu-stat-label">Tersedia</div>
                    </div>
                    <div class="menu-stat">
                        <div class="menu-stat-number" id="facultyOccupied">2</div>
                        <div class="menu-stat-label">Terpakai</div>
                    </div>
                </div>

                <button class="menu-button"  onclick="window.location.href='display_dosen.php'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8,5.14V19.14L19,12.14L8,5.14Z"/>
                    </svg>
                    View Faculty Room Display
                </button>
            </div>
        </div>
    </section>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>