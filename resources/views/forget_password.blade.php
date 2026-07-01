<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <h3 class="text-xl font-bold text-gray-700 mt-4">Reset Password</h3>
                <p class="text-gray-500 mt-2 font-medium">Enter your email address and we'll send you a link to reset your password.</p>
            </div>

            <form action="{{url('forget_password_process')}}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your registered email" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-educenter-yellow focus:border-educenter-yellow outline-none transition">
                </div>

                <button type="submit" 
                    class="w-full bg-educenter-yellow hover:bg-yellow-500 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-1">
                    RESET PASSWORD
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600">
                <a href="login" class="text-educenter-yellow font-bold hover:underline transition">
                    ← Back to Login
                </a>
            </div>
        </div>

        <div class="bg-gray-50 py-4 text-center text-xs text-gray-400 border-t">
            &copy; 2026 Educenter Inc. All rights reserved.
        </div>
    </div>

</body>
</html>