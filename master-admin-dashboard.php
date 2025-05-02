<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Master Admin Web Ruangan & Dosen</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      padding: 0;
      background: #f2f2f2;
    }
    nav {
      background-color: #2c3e50;
      color: white;
      padding: 1rem;
      display: flex;
      gap: 10px;
      justify-content: space-between;
      align-items: center;
    }
    nav button {
      background: #34495e;
      border: none;
      color: white;
      padding: 10px;
      cursor: pointer;
      border-radius: 4px;
    }
    nav button:hover {
      background: #1abc9c;
    }
    header {
      padding: 20px;
      background-color: white;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    main {
      padding: 20px;
    }
    section {
      display: none;
    }
    section.active {
      display: block;
    }
  </style>
</head>
<body>
  <nav>
    <div>
      <button onclick="showTab('home')">🏠 Home</button>
      <button onclick="showTab('rooms')">🏢 Daftar Ruangan</button>
      <button onclick="showTab('courses')">📝 Tambah Matakuliah</button>
      <button onclick="showTab('manual')">⚙️ Atur Status Ruangan</button>
      <button onclick="showTab('dosen')">👨‍🏫 Status Dosen</button>
      <button onclick="showTab('users')">👤 Kelola Pengguna</button>
    </div>
    <div>
      <span><?= htmlspecialchars($_SESSION['nama_lengkap']) ?> 👤</span>
      <button onclick="logout()">🚪 Logout</button>
    </div>
  </nav>

  <main>
    <header>
      <h1>Master Admin Sistem Ruangan & Dosen</h1>
    </header>

    <section id="home" class="active">
      <h2>Beranda</h2>
      <p>Selamat datang, Super Admin.</p>
    </section>

    <section id="rooms">
      <h2>Daftar Ruangan</h2>
      <!-- Konten daftar ruangan -->
    </section>

    <section id="courses">
      <h2>Tambah Mata Kuliah</h2>
      <!-- Form tambah matkul -->
    </section>

    <section id="manual">
      <h2>Atur Status Ruangan</h2>
      <!-- Konten pengaturan manual -->
    </section>

    <section id="dosen">
      <h2>Status Dosen</h2>
      <!-- Konten status dosen -->
    </section>

    <section id="users">
      <h2>Kelola Pengguna</h2>
      <!-- Konten kelola pengguna -->
    </section>
  </main>

  <script>
    function showTab(id) {
      document.querySelectorAll('section').forEach(section => section.classList.remove('active'));
      document.getElementById(id).classList.add('active');
    }

    function logout() {
      window.location.href = 'logout.php';
    }
  </script>
</body>
</html>
