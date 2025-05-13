<?php
session_start();
include '../config/db.php';

// Cek apakah sudah login
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['role'];
    switch ($role) {
        case 'super_admin':
            header("Location: ../Super_Admin/masteradmin.php");
            break;
        case 'laboran':
            header("Location: ../laboran/dashboard_laboran.php");
            break;
        case 'dosen':
            header("Location: ../dosen/dashboard.php");
            break;
        default:
            header("Location: ../public/index.php");
            break;
    }
    exit();
}

$error = '';

// Proses login saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $user['role'] === $role) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

            switch ($user['role']) {
                case 'super_admin':
                    header("Location: ../Super_Admin/masteradmin.php");
                    break;
                case 'laboran':
                    header("Location: ../Laboran/dashboard_laboran.php");
                    break;
                case 'dosen':
                    header("Location: ../Dosen/dashboard.php");
                    break;
                default:
                    header("Location: ../public/index.php");
                    break;
            }
            exit();
        } else {
            $error = "Email, password, atau role salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Pastikan file CSS ini tersedia -->
</head>

<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            
        <!-- Email -->
        <div class="input-group">
            <div class="icon"><i class="fas fa-envelope"></i></div>
            <input type="email" placeholder="Email" name="email" required>
        </div>

        <!-- Password -->
        <div class="input-group">
            <div class="icon"><i class="fas fa-lock"></i></div>
            <input type="password" placeholder="Password" name="password" required>
        </div>

        <!-- Role -->
        <div class="input-group">
            <div class="icon"><i class="fas fa-user-gear"></i></div>
            <select name="role" required>
                <option value="" disabled selected>Status</option>
                <option value="dosen">Dosen</option>
                <option value="laboran">Laboran</option>
                <option value="superadmin">Super Admin</option>
            </select>
        </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

</html>
