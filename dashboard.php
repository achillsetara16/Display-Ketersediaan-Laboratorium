<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Dapatkan data pengguna dari session
$role = $_SESSION['role'];
$nama_lengkap = $_SESSION['nama_lengkap'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $nama_lengkap; ?></h1>
    <p>Role: <?php echo ucfirst($role); ?></p>

    <h2>Menu:</h2>
    <ul>
        <li><a href="list_rooms.php">List Ruangan</a></li>
        <?php if ($role === 'superadmin'): ?>
            <li><a href="add_room.php">Tambah Ruangan</a></li>
        <?php endif; ?>
        <!-- Tampilkan menu berdasarkan peran -->
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>
