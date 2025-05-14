<?php if ($success): ?>
    <div class="bg-green-500 text-white p-2 rounded mb-4">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<div class="relative w-full h-[250px]">
    <!-- Background Header -->
    <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg"
        class="w-full h-full object-cover rounded-tl-lg rounded-tr-lg" />

    <div class="absolute inset-x-0 -bottom-14 flex justify-center">
        <img class="w-28 h-28 rounded-full border-4 border-white bg-white shadow-md object-cover"
            src="<?= $user['profile_photo_path'] ? '../storage/' . $user['profile_photo_path'] : 'https://th.bing.com/th/id/OIP.Icb6-bPoeUmXadkNJbDP4QHaHa?pid=ImgDet&w=178&h=178&c=7&dpr=1,5' ?>"
            alt="Foto Profil" />
    </div>
</div>

<div class="text-center mt-20">
    <p class="text-xl font-semibold"><?= htmlspecialchars($user['nama_lengkap']) ?></p>
    <p class="text-gray-600"><?= htmlspecialchars($user['email']) ?></p>
</div>

<div class="mx-auto my-10 p-5 bg-white shadow-lg rounded-lg border border-black-200">
    <h2 class="py-2 px-4 border-b border-gray-200 font-semibold text-2xl">Personal Info:</h2>
    <table class="min-w-full bg-white">
        <tbody>
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 font-semibold">Full Name</td>
                <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['nama_lengkap']) ?></td>
            </tr>
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 font-semibold">Email</td>
                <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['email']) ?></td>
            </tr>
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 font-semibold">Bio</td>
                <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['bio'] ?? '-') ?></td>
            </tr>
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 font-semibold">Role</td>
                <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($user['role'] ?? '-') ?></td>
            </tr>
            <tr>
                <td class="py-2 px-4 border-b border-gray-200 font-semibold">Status</td>
                <td class="py-2 px-4 border-b border-gray-200">
                    <span class="<?= $user['status'] === 'active' ? 'text-green-600' : 'text-red-600' ?>">
                        <?= htmlspecialchars($user['status'] ?? '-') ?>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="flex justify-center mt-6">
    <a href="edit-profile.php">
        <button
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md shadow-sm transition">
            Edit Profile
        </button>
    </a>
</div>