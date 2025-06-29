<?php
session_start();
include '../config/db.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND role = 'dosen'");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Dosen tidak ditemukan.";
    exit();
}

$success = $_SESSION['success'] ?? null;
unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Laboran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="gradient-bg font-sans">

<!-- Layout Utama -->
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-[250px]">
        <?php include '../partials/sidebar.php'; ?>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-4">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <?php include '../partials/profile_view.php'; ?>
        </div>
    </main>
    </div>


</body>

</html>