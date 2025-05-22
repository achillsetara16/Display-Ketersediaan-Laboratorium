<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Page</title>
  <link rel="stylesheet" href="../assets/css/master.css" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <span class="navbar-title">Master Admin</span>
    <a href="/logout" class="logout-link">
      <span class="logout-text">Logout</span>
    </a>
  </nav>

  <div class="main-container">
    <!-- Sidebar + Logo -->
    <div class="sidebar-wrapper">
      <div class="logo-container">
        <img src="../image/poltek.png" alt="Logo" class="logo-image" />
      </div>

      <div class="sidebar">
        <a href="dashboard.php" class="sidebar-item">
          <img src="../image/dashboard.png" class="icon" />
          <span>Dashboard</span>
        </a>
        <a href="/add" class="sidebar-item">
          <img src="../image/add1.png" class="icon" />
          <span>Add Rooms</span>
        </a>
        <a href="/users" class="sidebar-item">
          <img src="../image/users.png" class="icon" />
          <span>Users</span>
        </a>
        <a href="/rooms" class="sidebar-item">
          <img src="../image/rooms.png" class="icon" />
          <span>Rooms</span>
        </a>
        <a href="/bookings" class="sidebar-item">
          <img src="../image/add1.png" class="icon" />
          <span>Bookings</span>
        </a>
      </div>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="second-navbar">
        Rooms
      </div>

      <div class="content-box">
        <!-- Tempatkan isi form atau data lainnya di sini -->
        <p>Silakan tambahkan konten utama di sini...</p>
      </div>
    </div>
  </div>
</body>
</html>
