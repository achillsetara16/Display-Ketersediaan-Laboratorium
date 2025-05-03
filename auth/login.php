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
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Pastikan file CSS ini tersedia -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        input,
        button,
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        select:focus option[disabled] {
            display: none;
        }
    </style>
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
            <select name="role" required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="super_admin">Super Admin</option>
                <option value="laboran">Laboran</option>
                <option value="dosen">Dosen</option>
            </select>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>