<?php
session_start();
include '../config/db.php';

// Cek login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND role = 'laboran'");
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
    <title>Profil Dosen</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body>

    <div class="mx-auto p-4 w-full">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <?php include '../partials/profile_view.php'; ?>
        </div>
    </div>

    <?php include '../public/footer.php'; ?>
</body>

</html>