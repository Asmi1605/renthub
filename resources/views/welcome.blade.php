<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentHub - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center">

    <div class="text-center p-8 bg-white bg-opacity-70 backdrop-blur-md shadow-2xl rounded-2xl max-w-2xl w-full mx-4 animate-fade-in">
        <div class="flex justify-center mb-4">
            <lottie-player 
                src="https://assets9.lottiefiles.com/packages/lf20_jcikwtux.json"  
                background="transparent"  
                speed="1"  
                style="width: 180px; height: 180px;"  
                loop  
                autoplay>
            </lottie-player>
        </div>
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Welcome to <span class="text-blue-600">RentHub</span></h1>
        <p class="text-gray-600 mb-6 text-lg">Easily rent or list anything you need. Start your rental journey with us today.</p>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-full shadow hover:bg-blue-700 transition">
                Login
            </a>
            <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-white text-blue-600 font-semibold border border-blue-600 rounded-full hover:bg-blue-50 transition">
                Register
            </a>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
    </style>
</body>
</html>
