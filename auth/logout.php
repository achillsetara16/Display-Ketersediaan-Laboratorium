<?php
session_start();
include '../config/db.php';

if (isset($_SESSION['user_id'])) {
    // Ubah status ke 'inactive' sebelum logout
    $updateStatus = $pdo->prepare("UPDATE users SET status = 'inactive' WHERE id = :id");
    $updateStatus->execute([':id' => $_SESSION['user_id']]);
}

// Hancurkan sesi dan alihkan ke halaman login
session_destroy();
header("Location: login.php");
exit;
