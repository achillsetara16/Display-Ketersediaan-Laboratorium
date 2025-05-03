<?php
session_start();
include '../config/db.php';

// Cek apakah sudah login
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'];
    if ($role === 'superadmin') {
        header("Location: ../Super_Admin/masteradmin.php");
    } elseif ($role === 'laboran') {
        header("Location: ../laboran/dashboard_laboran.php");
    } elseif ($role === 'dosen') {
        header("Location: ../dosen/dashboard_dosen.php"); // ubah ke PHP
    } else {
        header("Location: ../public/index.php");
    }
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // ambil role dari input

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND role = :role");
    $stmt->execute(['email' => $email, 'role' => $role]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

            if ($user['role'] === 'superadmin') {
                header("Location: ../Super_Admin/masteradmin.php");
            } elseif ($user['role'] === 'laboran') {
                header("Location: ../laboran/dashboard_laboran.php");
            } elseif ($user['role'] === 'dosen') {
                header("Location: ../dosen/dashboard_dosen.php");
            } else {
                header("Location: ../public/index.php");
            }
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email atau role tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <!-- Tambahan Dropdown Role -->
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="superadmin">Superadmin</option>
                <option value="laboran">Laboran</option>
                <option value="dosen">Dosen</option>
            </select>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
