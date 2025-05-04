<?php
session_start();
include '../config/db.php'; // Menghubungkan file koneksi database

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'];

    // Redirect sesuai role
    if ($role === 'superadmin') {
        header("Location: ../Super_Admin/masteradmin.php");
    } elseif ($role === 'laboran') {
        header("Location: ../laboran/dashboard_laboran.php");
    } elseif ($role === 'dosen') {
        header("Location: ../dosen/dashboard.html");
    } else {
        header("Location: ../public/index.php"); // Atau halaman default jika role tidak ditemukan
    }
    exit();
}

// Proses registrasi jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $nama_lengkap = $_POST['nama_lengkap'];

    // Validasi jika password dan konfirmasi password tidak sama
    if ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak sama!";
    } else {
        // Hash password untuk penyimpanan di database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query untuk mengecek apakah email sudah terdaftar
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $error = "Email sudah terdaftar!";
        } else {
            // Query untuk menyimpan data pengguna baru ke database
            $stmt = $pdo->prepare("INSERT INTO users (email, password, role, nama_lengkap) VALUES (:email, :password, :role, :nama_lengkap)");
            $stmt->execute([
                'email' => $email,
                'password' => $hashed_password,
                'role' => $role,
                'nama_lengkap' => $nama_lengkap
            ]);

            // Redirect ke halaman login setelah registrasi berhasil
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background-color: #f4f4f4; }
        .form-container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); width: 300px; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; border-radius: 4px; border: 1px solid #ddd; }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .error { color: red; font-size: 14px; }

        select:focus option[disabled] {
    display: none;
}

    </style>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>
    <div class="form-container">
        <h2>Register</h2>

        <!-- Menampilkan pesan error jika ada -->
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <select name="role" required>
                <option value="" disabled selected>Status</option>
                <option value="dosen">Dosen</option>
                <option value="laboran">Laboran</option>
            </select>
            <button type="submit">Register</button>
        </form>

        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
