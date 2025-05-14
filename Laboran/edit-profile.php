<?php
session_start();
include '../config/db.php';

// Autentikasi user dan role dosen
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND role = 'laboran'");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Lecturer not found or you do not have access.";
    exit();
}

$success = $_SESSION['success'] ?? null;
unset($_SESSION['success']);
$error = null;

// Handle form update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $email = trim($_POST['email']);
    $bio = trim($_POST['bio']);
    $status = trim($_POST['status']);
    $profile_photo_path = $user['profile_photo_path'];

    // Upload foto jika ada
    if (!empty($_FILES['profile_photo_path']['name'])) {
        $file_name = $_FILES['profile_photo_path']['name'];
        $file_tmp = $_FILES['profile_photo_path']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed_ext)) {
            $new_file_name = uniqid('photo_', true) . '.' . $file_ext;
            $upload_dir = '../storage/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
            move_uploaded_file($file_tmp, $upload_dir . $new_file_name);
            $profile_photo_path = $upload_dir . $new_file_name;
        } else {
            $error = 'Invalid file format. Please use JPG, JPEG, or PNG.';
        }
    }

    // Simpan perubahan jika tidak ada error
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

        $_SESSION['success'] = 'Profile updated successfully!';
        header('Location: edit-profile.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil Dosen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-semibold text-center mb-6">Edit Profil Laboran</h1>

    <?php if ($success): ?>
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
        <div class="flex flex-col items-center mb-6">
            <div class="relative w-28 h-28">
                <img id="previewImage"
                     src="<?= $user['profile_photo_path'] ? $user['profile_photo_path'] : 'https://via.placeholder.com/150' ?>"
                     alt="Foto Profil"
                     class="w-28 h-28 rounded-full object-cover border-4 border-white shadow" />
                <label for="profile_photo_path"
                       class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full cursor-pointer hover:bg-blue-700 transition">
                    <svg xmlns="<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
     viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15.172 7l-6.586 6.586M8.586 7L15.172 13.586"/>
                    </svg>
                </label>
                <input type="file" id="profile_photo_path" name="profile_photo_path" class="hidden" onchange="loadPreview(event)">
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
