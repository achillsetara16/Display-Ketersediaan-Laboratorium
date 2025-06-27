<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NoLab - Laboratory Monitoring System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            --bg-gradient: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.12);
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.8);
            --text-muted: rgba(255, 255, 255, 0.6);
            --accent-color: #48bb78;
            --shadow-color: rgba(102, 126, 234, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-gradient);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Background Animation */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 25% 25%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 75% 75%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
            animation: backgroundPulse 8s ease-in-out infinite alternate;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes backgroundPulse {
            0% { opacity: 0.3; }
            100% { opacity: 0.6; }
        }

        /* Hero Section */
        .hero {
            padding: 6rem 2rem 4rem;
            text-align: center;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            background: var(--primary-gradient);
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.2;
            animation: heroGlow 6s ease-in-out infinite alternate;
        }

        @keyframes heroGlow {
            0% { transform: translate(-50%, -50%) scale(1); }
            100% { transform: translate(-50%, -50%) scale(1.2); }
        }

       .hero-title {
    font-size: clamp(3rem, 8vw, 5rem);
    font-weight: 900;
    margin-bottom: 1.5rem;
    color: white; /* Ganti warna jadi putih solid */
    letter-spacing: -0.05em;
    position: relative;
    z-index: 1;
}


        @keyframes gradientFlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 3vw, 1.4rem);
            color: var(--text-secondary);
            max-width: 700px;
            margin: 0 auto 3rem;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        /* Menu Section */
        .menu-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem 4rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--text-primary);
            background: linear-gradient(45deg, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            color: var(--text-muted);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }

        /* Enhanced Menu Cards */
        .menu-card {
            background: var(--glass-bg);
            backdrop-filter: blur(30px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            isolation: isolate;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(102, 126, 234, 0.1),
                transparent
            );
            transition: left 0.8s ease;
            z-index: -1;
        }

        .menu-card::after {
            content: '';
            position: absolute;
            inset: 0;
            padding: 1px;
            background: var(--primary-gradient);
            border-radius: 24px;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .menu-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 
                0 25px 50px rgba(102, 126, 234, 0.25),
                0 0 0 1px rgba(102, 126, 234, 0.1);
            background: rgba(255, 255, 255, 0.12);
        }

        .menu-card:hover::before {
            left: 100%;
        }

        .menu-card:hover::after {
            opacity: 1;
        }

        /* Card Content */
        .card-icon {
            width: 90px;
            height: 90px;
            background: var(--primary-gradient);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            position: relative;
            transition: all 0.4s ease;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        }

        .card-icon::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: var(--primary-gradient);
            border-radius: 24px;
            z-index: -1;
            filter: blur(8px);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .menu-card:hover .card-icon {
            transform: scale(1.15) rotate(8deg);
            box-shadow: 0 12px 48px rgba(102, 126, 234, 0.4);
        }

        .menu-card:hover .card-icon::before {
            opacity: 0.7;
        }

        .card-icon svg {
            width: 48px;
            height: 48px;
            fill: white;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-primary);
            line-height: 1.3;
        }

        .card-description {
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }

        .card-features {
            list-style: none;
            margin-bottom: 2rem;
            display: grid;
            gap: 0.75rem;
        }

        .card-features li {
            color: var(--text-muted);
            padding-left: 2rem;
            position: relative;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .card-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--accent-color);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .menu-card:hover .card-features li {
            color: var(--text-secondary);
        }

        /* Stats Section */
        .card-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Enhanced Button */
        .card-button {
            width: 100%;
            padding: 1.25rem 2rem;
            background: var(--primary-gradient);
            border: none;
            border-radius: 16px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        }

        .card-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .card-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 48px rgba(102, 126, 234, 0.4);
        }

        .card-button:hover::before {
            left: 100%;
        }

        .card-button:active {
            transform: translateY(-1px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .menu-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .menu-card {
                padding: 2rem;
            }
            
            .card-stats {
                padding: 1rem;
            }
            
            .hero {
                padding: 4rem 1rem 3rem;
            }
        }

        /* Loading animation for stats */
        .stat-number {
            animation: countUp 1s ease-out;
        }

        @keyframes countUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Focus states for accessibility */
        .menu-card:focus,
        .card-button:focus {
            outline: 2px solid rgba(102, 126, 234, 0.5);
            outline-offset: 2px;
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
    <!-- Navigation would be included here -->
    <!-- <?php include 'navbar.php'; ?> -->
    
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <h1 class="hero-title">NoLab</h1>
            <p class="hero-subtitle">
                Real-time laboratory availability monitoring system. Select the type of display you want to view to get
                the latest room status information across all facilities.
            </p>
        </section>

        <!-- Menu Selection Section -->
        <section class="menu-section">
            <div class="section-header">
                <h2 class="section-title">Select Display Type</h2>
                <p class="section-subtitle">
                    Choose from our comprehensive monitoring options to view real-time laboratory availability status
                </p>
<<<<<<< HEAD
=======
                
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
>>>>>>> 6b4af1d215cee4e957b419c625afeb9a76f5797c
            </div>

            <div class="menu-grid">
                <!-- Classroom Display Card -->
                <div class="menu-card" tabindex="0" role="button" aria-label="View Classroom Display">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M2,3V21H4V19H20V21H22V3H20V17H4V3H2M18,5V15H6V5H18M8,7V9H10V7H8M12,7V9H14V7H12M16,7V9H18V7H16M8,11V13H10V11H8M12,11V13H14V11H12M16,11V13H18V11H16Z" />
                        </svg>
                    </div>
                    
                    <h3 class="card-title">Classroom Display</h3>
                    <p class="card-description">
                        Comprehensive monitoring of classrooms, computer laboratories, practical rooms, and specialized learning facilities with real-time availability tracking.
                    </p>

                    <ul class="card-features">
                        <li>Computer & Multimedia Laboratories</li>
                        <li>Practical & Experiment Rooms</li>
                        <li>Regular Lecture Classrooms</li>
                        <li>Studios & Workshop Spaces</li>
                    </ul>

                    <div class="card-stats">
                        <div class="stat-item">
                            <div class="stat-number">12</div>
                            <div class="stat-label">Total Rooms</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">6</div>
                            <div class="stat-label">Available</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">6</div>
                            <div class="stat-label">In Use</div>
                        </div>
                    </div>

                    <button class="card-button" onclick="window.location.href='select_room.php'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M8,5.14V19.14L19,12.14L8,5.14Z" />
                        </svg>
                        Select Room Display
                    </button>
                </div>

                <!-- Faculty Display Card -->
                <div class="menu-card" tabindex="0" role="button" aria-label="View Faculty Room Display">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12,3L1,9L12,15L21,10.09V17H23V9M5,13.18V17.18L12,21L19,17.18V13.18L12,17L5,13.18Z" />
                        </svg>
                    </div>
                    
                    <h3 class="card-title">Faculty Room Display</h3>
                    <p class="card-description">
                        Advanced monitoring system for lecturer presence in individual offices, meeting rooms, consultation spaces, and academic administration areas.
                    </p>

                    <ul class="card-features">
                        <li>Individual Lecturer Offices</li>
                        <li>Meeting & Conference Rooms</li>
                        <li>Student Consultation Spaces</li>
                        <li>Academic Administration Areas</li>
                    </ul>

                    <div class="card-stats">
                        <div class="stat-item">
                            <div class="stat-number">1</div>
                            <div class="stat-label">Total Rooms</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">0</div>
                            <div class="stat-label">Available</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">1</div>
                            <div class="stat-label">In Use</div>
                        </div>
                    </div>

                    <button class="card-button" onclick="window.location.href='display_dosen.php'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M8,5.14V19.14L19,12.14L8,5.14Z" />
                        </svg>
                        View Faculty Room Display
                    </button>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer would be included here -->
    <!-- <?php include 'footer.php'; ?> -->

    <script>
        // Enhanced interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Add keyboard navigation
            const menuCards = document.querySelectorAll('.menu-card');
            
            menuCards.forEach(card => {
                card.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        const button = card.querySelector('.card-button');
                        if (button) {
                            button.click();
                        }
                    }
                });

                // Add ripple effect on click
                card.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    const rect = card.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: radial-gradient(circle, rgba(102, 126, 234, 0.3) 0%, transparent 70%);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                        z-index: 0;
                    `;
                    
                    card.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Animate stats on scroll
            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const stats = entry.target.querySelectorAll('.stat-number');
                        stats.forEach(stat => {
                            stat.style.animation = 'countUp 1s ease-out';
                        });
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.card-stats').forEach(stats => {
                observer.observe(stats);
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>