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
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

</head>

<body class="bg-gray-100 font-sans">
    <style>

.sidebar ul {
    list-style: none;
    padding: 0;
}


.sidebar ul li a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    color: white; /* Ubah warna default link */
    text-decoration: none; /* Hapus garis bawah */
}


.sidebar ul li a .icon {
    font-size: 1.2rem;
}

.sidebar ul li a:hover {
    color: #ffffff;
    background-color: #3AAFA9; /* warna saat hover */
}

.active {
    background-color: #def2f1;
    color: #17252A !important;
    font-weight: bold;
    border-left: 4px solid #3AAFA9; /* opsional untuk penanda */
}

.sidebar .logo-container {
    margin-top: 20px; /* Tambah jarak dari atas */
    display: flex;
    justify-content: center;  /* Mengatur posisi horizontal ke tengah */
    align-items: center;      /* Mengatur posisi vertikal ke tengah */
    height: 80px;             /* Atur tinggi container logo */
    padding: 10px;            /* Berikan jarak sedikit di sekitar logo */
}

.sidebar .logo-container img {
    width: 100%;
    height: auto;
    max-width: 120px;  /* Atur ukuran maksimal gambar */
    max-height: 120px; /* Atur tinggi maksimal gambar */
    object-fit: contain;  /* Agar gambar tetap terjaga proporsinya */
}

.logo-divider {
    height: 2px;
    background-color: #ddd;
    margin: 20px 20px;  /* Jarak garis dari logo dan sisi kiri-kanan */
}

.gradient-bg {
    background: linear-gradient(135deg, #2d1b69 0%, #11998e 100%);
}
    </style>

<!-- Layout Utama -->
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-[250px] bg-[#2B7A78]">
        <?php include '../partials/sidebar.php'; ?>
    </aside>

    <!-- Konten Utama -->
    <main class="gradient-bg flex-1 p-2">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <?php include '../partials/profile_view.php'; ?>
        </div>
    </main>

</div>
</body>

</html>