<?php
session_start();
include 'db.php'; // Menghubungkan file koneksi database

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // Redirect ke halaman dashboard jika sudah login
    exit();
}

// Proses login jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna berdasarkan email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan informasi pengguna di session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            
            // Redirect ke halaman dashboard atau halaman yang sesuai
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak terdaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background-color: #f4f4f4; }
        .form-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 4px; border: 1px solid #ddd; }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        
        <!-- Menampilkan pesan error jika ada -->
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
