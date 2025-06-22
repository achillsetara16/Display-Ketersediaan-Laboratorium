<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - InnovateTech</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
            background: #0a0a0a;
        }

        .hero-section {
            height: 100vh;
            background: linear-gradient(135deg, #2B7A78 0%, #1e5f8a 50%, #0c4a6e 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grid" width="50" height="50" patternUnits="userSpaceOnUse"><path d="M 50 0 L 0 0 0 50" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>')
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) { width: 80px; height: 80px; top: 20%; left: 10%; animation-delay: 0s; }
        .shape:nth-child(2) { width: 120px; height: 120px; top: 60%; right: 15%; animation-delay: 2s; }
        .shape:nth-child(3) { width: 60px; height: 60px; bottom: 20%; left: 20%; animation-delay: 4s; }
        .shape:nth-child(4) { width: 100px; height: 100px; top: 30%; right: 30%; animation-delay: 1s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .hero-content {
            text-align: center;
            color: white;
            z-index: 2;
            max-width: 800px;
            padding: 0 20px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #ffffff, #a0d8d6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(43, 122, 120, 0.3);
            background-size: 200% 200%;
            
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .hero-subtitle {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            font-weight: 300;
        }

        .hero-description {
            font-size: 1.2rem;
            line-height: 1.6;
            opacity: 0.85;
            max-width: 700px;
            margin: 0 auto;
            font-weight: 300;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
            40% { transform: translateX(-50%) translateY(-10px); }
            60% { transform: translateX(-50%) translateY(-5px); }
        }

        .content-section {
            background: linear-gradient(180deg, #0a0a0a 0%, #1a1a1a 100%);
            padding: 80px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-title {
            font-size: 3rem;
            color: white;
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #2B7A78, #1e5f8a);
            border-radius: 2px;
        }

        .story-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-bottom: 80px;
        }

        .story-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .story-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #2B7A78, #1e5f8a);
        }

        .story-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(43, 122, 120, 0.2);
        }

        .story-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #2B7A78, #1e5f8a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .story-title {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .story-text {
            color: #b0b0b0;
            line-height: 1.6;
            font-size: 1rem;
        }

        .team-section {
            background: #1a1a1a;
            padding: 80px 0;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }

        .team-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(43, 122, 120, 0.1), transparent);
            animation: rotate 10s linear infinite;
            z-index: 0;
        }

        .team-card-content {
            position: relative;
            z-index: 1;
        }

        @keyframes rotate {
            100% { transform: rotate(360deg); }
        }

        .team-card:hover {
            transform: scale(1.05);
        }

        .team-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2B7A78, #1e5f8a);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
            font-weight: bold;
        }

        .team-name {
            font-size: 1.3rem;
            color: white;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .team-role {
            color: #2B7A78;
            margin-bottom: 15px;
            font-weight: 500;
        }

        .team-bio {
            color: #b0b0b0;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .stats-section {
            background: #0a0a0a;
            padding: 80px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-top: 60px;
        }

        .stat-card {
            text-align: center;
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(45deg, #2B7A78, #1e5f8a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #b0b0b0;
            font-size: 1.1rem;
            font-weight: 500;
        }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        .hero-description {
            font-size: 0.9rem;
        }   

        .section-title {
            font-size: 1.5rem;
        }

        .story-card, .team-card {
            padding: 20px;
        }

        .story-text, .team-bio {
            font-size: 0.85rem;
        }

        .logo {
            width: 80px;
            height: 80px;
        }

        .logo-text {
            font-size: 1.5rem;
        }

        .scroll-indicator {
            bottom: 15px;
            font-size: 0.9rem;
        }
    }

    @media (min-width: 1024px) and (max-width: 1366px) {
        .hero-title {
            font-size: 3.5rem;
        }

        .hero-subtitle {
            font-size: 1.4rem;
        }

        .hero-description {
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 2.5rem;
        }

        .story-card, .team-card {
            padding: 30px;
        }

        .story-text, .team-bio {
            font-size: 1rem;
        }

        .logo {
            width: 120px;
            height: 120px;
        }

        .logo-text {
            font-size: 2.2rem;
        }

        .stat-number {
            font-size: 2.5rem;
        }
    }


    </style>
</head>
<body>
  <?php include 'navbar.php' ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg"></div>
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <div class="hero-content">
            <h1 class="hero-title">About NoLab</h1>
            <p class="hero-subtitle">Smart Lab, Smart Future</p>
            <p class="hero-description">NoLab is a smart laboratory room monitoring system developed for the Polibatam campus community. It provides real-time updates on room availability, lecturer presence, and lab schedules, making it easier for students and staff to access and utilize lab facilities efficiently.</p>
        </div>
        <div class="scroll-indicator">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l-7 7h4v10h6v-10h4l-7-7z"/>
            </svg>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="content-section">
        <div class="container">
            <h2 class="section-title">Our Story</h2>
            <div class="story-grid">
                <div class="story-card">
                    <div class="story-icon">🚀</div>
                    <h3 class="story-title">Our Mission</h3>
                    <p class="story-text">To develop a web-display system integrated with APIs and IoT device (Raspberry Pi and sensor PIR) that delivers accurate and up-to-date room and lecturer status information.</p>
                </div>
                <div class="story-card">
                    <div class="story-icon">🎯</div>
                    <h3 class="story-title">Our Vision</h3>
                    <p class="story-text">To become a pioneer in real-time information systems that support efficiency and transparency of academic activities within campus environments.</p>
                </div>
                <div class="story-card">
                    <div class="story-icon">⚡</div>
                    <h3 class="story-title">Our Values</h3>
                    <p class="story-text">Real-time Accuracy, System Integration, Ease of Acces, information Transparency, and Continuous Innovation are the core values we uphold in every system development.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-card-content">
                        <div class="team-avatar">MAA</div>
                        <h3 class="team-name">Masruri Abdul Aziz Amrulloh</h3>
                        <p class="team-role">Leader & Fullstack Developer</p>
                        <p class="team-bio">...</p>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-card-content">
                        <div class="team-avatar">DPS</div>
                        <h3 class="team-name">Donni Pernanda Simanjuntak</h3>
                        <p class="team-role">Fullstack Developer</p>
                        <p class="team-bio">...</p>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-card-content">
                        <div class="team-avatar">RKD</div>
                        <h3 class="team-name">Rizko Kembara Dhani</h3>
                        <p class="team-role">Fullstack Developer</p>
                        <p class="team-bio">...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <!-- <section class="stats-section">
        <div class="container">
            <h2 class="section-title">Our Impact</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Projects Completed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Happy Clients</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support Available</div>
                </div>
            </div>
        </div>
    </section> -->

    <script>
        // Add smooth scrolling animation
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.story-card, .team-card, .stat-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                observer.observe(card);
            });

            // Add keyframes for fadeInUp animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeInUp {
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `;
            document.head.appendChild(style);

            // Parallax effect for floating shapes
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const shapes = document.querySelectorAll('.shape');
                shapes.forEach((shape, index) => {
                    const speed = 0.5 + (index * 0.1);
                    shape.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
                });
            });
        });
    </script>
    <?php include 'footer.php' ?>
</body>
</html>