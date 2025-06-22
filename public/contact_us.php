<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Lab Polibatam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #2d1b69 0%, #11998e 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .input-focus {
            transition: all 0.3s ease;
        }
        
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 58, 138, 0.2);
            border-color: #1e3a8a;
        }
        
        .btn-hover {
            transition: all 0.3s ease !important;
            background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 50%, #581c87 100%) !important;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.4) !important;
        }
        
        .section-animation {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.8s ease forwards;
        }
        
        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    <?php include 'navbar.php'; ?>

    <!-- Hero Section -->
     <section class="pt-24">
        <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="text-center mb-4 section-animation">
            <h1 class="text-5xl font-bold text-white mb-4 floating-animation">
                Get In <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">Touch</span>
            </h1>
            <p class="text-xl text-white/80 max-w-2xl mx-auto">
                Feel free to send us your questions, feedback, or reports using the form below
            </p>
        </div>
     </section>

        <!-- Contact Form -->
         <section class="pb-20">
            <div class="max-w-4xl mx-auto section-animation" style="animation-delay: 0.2s;">
            <div class="glass-effect rounded-2xl p-8 shadow-2xl">
                <form action="process.php" method="POST" class="space-y-6">
                    <!-- Name Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="text-purple-600">●</span> First Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    name="first_name" 
                                    required 
                                    class="w-full pl-10 pr-4 py-4 border-2 border-gray-200 rounded-xl input-focus focus:outline-none" 
                                    placeholder="Enter your first name"
                                >
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="text-purple-600">●</span> Last Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    name="last_name" 
                                    required 
                                    class="w-full pl-10 pr-4 py-4 border-2 border-gray-200 rounded-xl input-focus focus:outline-none" 
                                    placeholder="Enter your last name"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Email and Phone in Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="text-purple-600 mr-2">●</span> Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="email" 
                                    name="email" 
                                    required 
                                    class="w-full pl-10 pr-4 py-4 border-2 border-gray-200 rounded-xl input-focus focus:outline-none" 
                                    placeholder="you@example.com"
                                >
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <span class="text-gray-400 mr-2">●</span> Phone Number <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="tel" 
                                    name="handphone" 
                                    class="w-full pl-10 pr-4 py-4 border-2 border-gray-200 rounded-xl input-focus focus:outline-none" 
                                    placeholder="081234567890"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Topic -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <span class="text-purple-600">●</span> Topic
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <select 
                                name="topik" 
                                class="w-full pl-10 pr-4 py-4 border-2 border-gray-200 rounded-xl input-focus focus:outline-none bg-white appearance-none"
                            >
                                <option value="Schedule">📅 Lab Schedule</option>
                                <option value="Booking">🔒 Lab Booking</option>
                                <option value="Issue">⚠️ System Issue</option>
                                <option value="Other">💬 Other</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                
                            </div>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">
                            <span class="text-purple-600">●</span> Message
                        </label>
                        <div class="relative">
                            <div class="absolute top-4 left-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <textarea 
                                name="pesan" 
                                required 
                                class="w-full pl-10 pr-4 py-4 border-2 border-gray-200 rounded-xl input-focus focus:outline-none resize-none" 
                                rows="5" 
                                placeholder="Tell us how we can help you..."
                            ></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            class="w-full md:w-auto btn-hover text-white font-semibold px-8 py-4 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-300"
                        >
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Send Message
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
      </div>
         </section>
      <?php include 'footer.php' ?>
    </div>

    <!-- SweetAlert Trigger -->
    <script>
        // Simulate status parameter for demo
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        
        if (status === 'sukses') {
            Swal.fire({
                title: 'Success!',
                text: 'Your message has been sent.',
                icon: 'success',
                confirmButtonColor: '#1e3a8a'
            });
        } else if (status === 'gagal') {
            Swal.fire({
                title: 'Failed!',
                text: 'An error occurred while sending your message.',
                icon: 'error',
                confirmButtonColor: '#1e3a8a'
            });
        }

        // Add some interactivity
        document.querySelectorAll('input, textarea, select').forEach(element => {
            element.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            element.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>