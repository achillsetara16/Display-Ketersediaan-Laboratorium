<?php
session_start();
require '../config/db.php';

// Redirect jika belum login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$success = $_SESSION['success'] ?? null;
unset($_SESSION['success']);
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $email = trim($_POST['email']);
    $bio = trim($_POST['bio']);
    $status = trim($_POST['status']);
    $profile_photo_path = $user['profile_photo_path'];

    // Cek apakah ada file diupload
    if (!empty($_FILES['profile_photo_path']['name'])) {
        $file = $_FILES['profile_photo_path'];
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed_ext)) {
            $upload_dir = '../storage/';
            $new_file_name = uniqid('profile_', true) . '.' . $file_ext;
            $full_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file['tmp_name'], $full_path)) {
                $profile_photo_path = $full_path;
            } else {
                $error = 'Gagal mengunggah gambar.';
            }
        } else {
            $error = 'Format file tidak didukung! Harus JPG, JPEG, atau PNG.';
        }
    }

    // Simpan ke database jika tidak ada error
    if (!$error) {
        $stmt = $pdo->prepare("
            UPDATE users 
            SET nama_lengkap = :nama_lengkap, email = :email, bio = :bio, 
                 profile_photo_path = :profile_photo_path 
            WHERE id = :user_id
        ");
        $stmt->execute([
            'nama_lengkap' => $nama_lengkap,
            'email' => $email,
            'bio' => $bio,
            'profile_photo_path' => $profile_photo_path,
            'user_id' => $user_id
        ]);

        $_SESSION['success'] = 'Profil berhasil diperbarui!';
        header('Location: edit-profile.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto mt-10 bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-semibold mb-6 text-center">Edit Profil</h2>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
        <div class="flex flex-col items-center mb-6">
            <div class="relative w-28 h-28">
                <img id="previewImage"
                     class="w-28 h-28 rounded-full object-cover border-4 border-white shadow"
                     src="<?= htmlspecialchars($user['profile_photo_path'] ?? 'https://via.placeholder.com/150') ?>"
                     alt="Profile" />
                <label for="profile_photo_path"
                       class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full cursor-pointer hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15.172 7l-6.586 6.586M8.586 7L15.172 13.586" />
                    </svg>
                </label>
                <input id="profile_photo_path" name="profile_photo_path" type="file" class="hidden"
                       onchange="loadPreview(event)">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']) ?>"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea name="bio" rows="4"
                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"><?= htmlspecialchars($user['bio']) ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <input type="text" value="<?= htmlspecialchars($user['role']) ?>"
                       class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm p-2 text-gray-600" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <input type="text" value="<?= htmlspecialchars($user['status']) ?>"
                       class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm p-2 text-gray-600" readonly>
            </div>
        </div>

        <div class="mt-8 flex justify-center gap-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition">
                Save
            </button>
            <a href="profile.php"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-md transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
    function loadPreview(event) {
        const image = document.getElementById('previewImage');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
</body>
</html>
