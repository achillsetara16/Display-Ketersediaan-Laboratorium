<?php
session_start();
require './function.php';

// Contoh data user (biasanya dari database)
$user = [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'last_education' => 'S2 Teknik Informatika',
    'position' => 'Dosen',
    'profile_photo_path' => '', // ganti sesuai path sebenarnya jika tersedia
];

// Contoh session flash success
$successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : null;
unset($_SESSION['success']); // flash message hanya sekali tampil
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="profile.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>
<body>

<div class="mx-auto p-4 w-full">
    <div class="bg-white p-4 rounded-lg shadow-md">

        <?php if ($successMessage): ?>
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                <?= htmlspecialchars($successMessage) ?>
            </div>
        <?php endif; ?>

        <div class="relative w-full h-[250px]">
            <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg"
                 class="w-full h-full object-cover rounded-tl-lg rounded-tr-lg" />

            <img class="w-28 h-28 rounded-full border-3 border-white absolute -bottom-14 left-1/2 transform -translate-x-1/2 bg-white shadow-md"
                 src="<?= $user['profile_photo_path'] ? 'storage/' . $user['profile_photo_path'] : 'images/default-profile.jpg' ?>"
                 alt="Profile Picture" />
        </div>

        <div class="text-center mt-17">
            <p class="text-xl font-semibold"><?= htmlspecialchars($user['name']) ?></p>
            <p class="text-gray-600"><?= htmlspecialchars($user['email']) ?></p>
        </div>
        
        <div class="mx-auto my-10 p-5 bg-white shadow-lg rounded-lg">
            <h2 class="py-2 px-4 border-b border-gray-200 font-semibold text-2xl">Personal Info: </h2>
            <table class="min-w-full bg-white">
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 font-semibold">Name</td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['name']) ?></td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 font-semibold">Email</td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['email']) ?></td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 font-semibold">Last Education</td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['last_education']) ?></td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 font-semibold">Position</td>
                        <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['position']) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-center mt-6">
            <a href="edit-profile.php">
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow-sm transition">
                    Edit Profile
                </button>
            </a>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
</body>
</html>
