<?php
session_start();
include '../config/db.php';

// Autentikasi user dan role super admin
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id AND role = 'superadmin'");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Super Admin not found or you do not have access.";
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
        header('Location: profile.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #2d1b69 0%, #11998e 100%);
        }
    </style>
</head>
<body class="gradient-bg">
<div class="max-w-3xl mx-auto mt-4 mb-4 bg-white px-8 pt-8 pb-10 rounded shadow">
    <h1 class="text-2xl font-semibold text-center mb-6">Edit Profile Super Admin</h1>

    <?php if ($success): ?>
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
        <div class="flex flex-col items-center space-y-4">
    <div class="relative w-32 h-32 mb-10">
        <!-- Foto Profil -->
    <div class="group w-full h-full rounded-full overflow-hidden shadow-lg border-1 border-white">
        <img 
            id="previewImage"
            src="<?= $user['profile_photo_path'] ? $user['profile_photo_path'] : '../image/hehehoho.jpg' ?>"
            alt="Foto Profil"
            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" />

        <!-- Overlay Kamera Saat Hover -->
        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center rounded-full">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </div>
        </div>
        
        <!-- Tombol Upload (ikon kamera di pojok) -->
<label for="profile_photo_path" class="absolute -bottom-2 -right-0 bg-gradient-to-r from-blue-500 to-purple-600 text-white p-2 rounded-full shadow-md cursor-pointer hover:scale-110 transition duration-300 border-4 border-white">
    <!-- Ikon Kamera -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 7h4l2-2h6l2 2h4v12H3V7z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 11a3 3 0 100 6 3 3 0 000-6z" />
    </svg>
</label>

        <!-- Input File (disembunyikan) -->
        <input type="file" id="profile_photo_path" name="profile_photo_path" class="hidden" accept="image/*" onchange="loadPreview(event)">
    </div>
</div>


        <div class="grid md:grid-cols-2 gap-6">
             <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="nama_lengkap" value="<?= ucwords(strtolower(htmlspecialchars($user['nama_lengkap']))) ?>"
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
                <input type="text" value="<?= ucwords(strtolower(htmlspecialchars($user['role']))) ?>"
                       class="mt-1 block w-full bg-gray-100 border border-gray-300 rounded-md shadow-sm p-2 text-gray-600" readonly>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <input type="text" value="<?= ucwords(strtolower(htmlspecialchars($user['status']))) ?>"
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
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>
