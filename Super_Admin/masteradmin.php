<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'superadmin') {
  header("Location: ../auth/login.php");
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
    * {
      box-sizing: border-box;
    }
    body {
      font-family: sans-serif;
      margin: 0;
      display: flex;
      height: 100vh;
      background: #f2f2f2;
    }

    nav {
      width: 220px;
      background-color: #2c3e50;
      color: white;
      display: flex;
      flex-direction: column;
      padding: 20px 10px;
    }

    nav button {
      background: #34495e;
      border: none;
      color: white;
      padding: 10px;
      margin: 5px 0;
      cursor: pointer;
      border-radius: 4px;
      text-align: left;
    }

    nav button:hover {
      background: #1abc9c;
    }

    .topbar {
      background-color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .profile img {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      cursor: pointer;
    }

    main {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    section {
      display: none;
      padding: 20px;
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
    </div>
    <div>
        <span><?= htmlspecialchars($_SESSION['nama_lengkap']) ?> 👤</span>
        <!-- Link profil langsung menuju halaman profil.php -->
        <a href="profil.php">
            <button class="bg-gray-600 text-white px-4 py-2 rounded-md">
                👤 Profil
            </button>
        </a>
        <button onclick="logout()">🚪 Logout</button>
    </div>
</nav>


  <main>
    <div class="topbar">
      <h2>Master Admin Sistem Ruangan & Dosen</h2>
      <div class="profile" onclick="showTab('profile')">
        <img src="https://via.placeholder.com/32" alt="Profil">
        <span><?= htmlspecialchars($_SESSION['nama_lengkap']) ?></span>
      </div>
    </div>

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

    <section id="profile">
      <h2>Profil</h2>
      <form>
        <label>Nama Lengkap:</label><br>
        <input type="text" value="<?= htmlspecialchars($_SESSION['nama_lengkap']) ?>" readonly><br><br>
        <label>Role:</label><br>
        <input type="text" value="<?= htmlspecialchars($_SESSION['role']) ?>" readonly><br><br>
        <!-- Tambahkan fitur edit profil jika diperlukan -->
      </form>
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
