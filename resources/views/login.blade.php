<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .bg-educenter-yellow { background-color: #ffbc06; }
        .text-educenter-yellow { color: #ffbc06; }

        .auth-bg {
            background: linear-gradient(rgba(30, 30, 75, 0.85), rgba(30, 30, 75, 0.85)),
                        url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="auth-bg min-h-screen flex items-center justify-center font-sans p-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">

        <div class="h-2 bg-educenter-yellow w-full"></div>

        <div class="p-8 md:p-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800 italic">edu<span class="text-gray-400">center</span></h2>
                <p class="text-gray-500 mt-2 font-medium">Welcome back! Please login to your account.</p>
            </div>

            @if (session('error'))
    <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100 flex items-center gap-3">
        <i class="fa-solid fa-circle-exclamation"></i>
        <p class="font-bold">{{ session('error') }}</p>
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
        <ul class="list-disc pl-5 font-bold">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form action="{{url('/login')}}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" placeholder="axita@gmail.com" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-educenter-yellow focus:border-educenter-yellow outline-none transition">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-sm font-bold text-gray-700">Password</label>
                        <a href="forget_password" class="text-xs text-educenter-yellow hover:underline">Forgot Password?</a>
                    </div>

                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="*******" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-educenter-yellow focus:border-educenter-yellow outline-none transition pr-10">

                        <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-educenter-yellow" onclick="togglePassword()">
                            <i id="toggleIcon" class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="w-4 h-4 text-educenter-yellow border-gray-300 rounded focus:ring-educenter-yellow">
                    <label for="remember" class="ml-2 text-sm text-gray-600 font-medium cursor-pointer">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full bg-educenter-yellow hover:bg-yellow-500 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-1 mt-2">
                    LOGIN NOW
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="register" class="text-educenter-yellow font-bold hover:underline transition">Register here</a>
            </div>
        </div>

        <div class="bg-gray-50 py-4 text-center text-xs text-gray-400 border-t">
            &copy; 2026 Educenter Inc. All rights reserved.
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
               
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";

                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>

</body>
</html>
