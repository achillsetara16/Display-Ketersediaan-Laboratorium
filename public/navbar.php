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

</head>

<body>

    <nav class="bg-[#2B7A78] flex flex-wrap items-center justify-between px-6 py-4 fixed top-0 left-0 right-0 z-50">
    <!-- Logo & Judul -->
    <div class="flex items-center text-[2.5rem] text-white font-bold">
        <img src="../image/poltek.png" alt="Logo" class="w-24 h-auto mr-4">
        NoLab
    </div>

    <!-- Tombol Hamburger -->
    <button data-collapse-toggle="navbar-default" type="button"
        class="inline-flex items-center p-2 text-sm text-white rounded-lg md:hidden hover:bg-white/10 focus:outline-none"
        aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Menu -->
    <div class="hidden w-full md:flex md:w-auto" id="navbar-default">
        <ul class="flex flex-col md:flex-row md:items-center gap-4 md:gap-12 text-white text-2xl mt-4 md:mt-0">
            <li><a href="index.php" class="hover:underline block py-2 md:py-0">Home</a></li>
            <li><a href="contact_us.php" class="hover:underline block py-2 md:py-0">Contact Us</a></li>
            <li><a href="about_us.php" class="hover:underline block py-2 md:py-0">About Us</a></li>
            <li><a href="../auth/login.php" class="hover:underline block py-2 md:py-0">Login</a></li>
        </ul>
    </div>
</nav>



</body>

</html>