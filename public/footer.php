<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Footer User</title>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
<!-- Flowbite CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <link rel="stylesheet" href="../assets/css/app.css">
</head>
<body class="min-h-screen flex flex-col">

<footer class="w-full bg-[#2F81DF] text-white">
    <div class="w-full px-6 py-10 grid md:grid-cols-2 gap-15">

    <div class="flex flex-col items-center md:items-start text-center md:text-left">
      <img src="../assets/image/Logo Polibatam 2024.png" alt="Logo Polibatam" class="w-60 h-auto mb-2">
      <h1 class="text-2xl font-bold mb-1">SIKL</h1>
      <p class="text-lg">Politeknik Negeri Batam</p>
    </div>

    <div class="space-y-10">
      <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 flex-shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a2 2 0 00-2.828 0L6.343 16.657a8 8 0 1111.314 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <div>
          <p class="font-semibold text-gray-200">Alamat:</p>
          <p>Jl. Ahmad Yani Batam Kota, Kota Batam, Kepulauan Riau</p>
        </div>
      </div>

      <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-white" viewBox="0 0 20 20" fill="currentColor">
          <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016.615 4H3.385a2 2 0 00-1.382 1.884zM18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
        </svg>
        <div>
          <p class="font-semibold text-gray-200">Email:</p>
          <a href="mailto:info@polibatam.ac.id" class="hover:underline hover:text-gray-100 transition">info@polibatam.ac.id</a><br>
          <a href="mailto:helpdesk1074@polibatam.ac.id" class="hover:underline hover:text-gray-100 transition">helpdesk1074@polibatam.ac.id</a>
        </div>
      </div>

      <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 flex-shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.357 4.072a1 1 0 01-.21.95l-2.198 2.198a11.042 11.042 0 005.586 5.586l2.198-2.198a1 1 0 01.95-.21l4.072 1.357a1 1 0 01.684.948V19a2 2 0 01-2 2h-1c-9.941 0-18-8.059-18-18V5z" />
        </svg>
        <div>
          <p class="font-semibold text-gray-200">Phone:</p>
          <a href="tel:+62778469858" class="hover:underline hover:text-gray-100 transition">+62-778-469858</a>
        </div>
      </div>
    </div>

  </div>

  <div class="text-center text-sm text-gray-300 py-5">
    &copy; <?= date('Y') ?> Polibatam. All rights reserved.
  </div>
</footer>

</body>
</html>
