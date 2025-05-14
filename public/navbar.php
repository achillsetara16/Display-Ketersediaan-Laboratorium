<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar User</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/app.css">
</head>

<body>

    <nav class="bg-[#2B7A78] flex justify-between items-center px-12 py-4">
        <div class="flex items-center text-[2.5rem] text-white font-bold">
            <img src="../assets/image/Logo Polibatam 2024.png" alt="Logo" class="w-24 h-auto mr-4">
            SKIL
        </div>
        <div class="flex items-center text-2xl gap-12 text-white">
            <a href="/Display-Ketersediaan-Laboratorium/public/index.php" class="hover:underline">Home</a>
            <a href="/Display-Ketersediaan-Laboratorium/public/contact.php" class="hover:underline">Contact Us</a>
            <a href="/Display-Ketersediaan-Laboratorium/public/about.php" class="hover:underline">About Us</a>
            <a href="/Display-Ketersediaan-Laboratorium/auth/login.php" class="hover:underline">Login</a>
        </div>
    </nav>

</body>

</html>