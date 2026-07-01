<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password | Educenter</title>
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
                <h3 class="text-xl font-bold text-gray-700 mt-4">Create New Password</h3>
                <p class="text-gray-500 mt-2 font-medium">Please enter your new password below.</p>
            </div>

            <form action="{{url('update_password')}}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="email" value="{{ $email ?? '' }}">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">New Password</label>
                    <div class="relative">
                        <input type="password" id="new_password" name="password" placeholder="*******" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-educenter-yellow focus:border-educenter-yellow outline-none transition pr-10">
                            @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-educenter-yellow" onclick="togglePassword('new_password', 'toggleIcon1')">
                            <i id="toggleIcon1" class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Confirm New Password</label>
                    <div class="relative">
                        <input type="password" id="confirm_password" name="password_confirmation" placeholder="*******" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-educenter-yellow focus:border-educenter-yellow outline-none transition pr-10">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-educenter-yellow" onclick="togglePassword('confirm_password', 'toggleIcon2')">
                            <i id="toggleIcon2" class="fa-solid fa-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-educenter-yellow hover:bg-yellow-500 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-1 mt-2">
                    UPDATE PASSWORD
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(iconId);

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