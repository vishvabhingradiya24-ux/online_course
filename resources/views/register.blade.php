<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap');
        
        body { font-family: 'Outfit', sans-serif; }
        .bg-educenter-yellow { background-color: #ffbc06; }
        .text-educenter-yellow { color: #ffbc06; }
        .bg-educenter-navy { background-color: #1e1e4b; }
        
        .auth-bg {
            background: linear-gradient(rgba(30, 30, 75, 0.85), rgba(30, 30, 75, 0.85)), 
                        url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }

        .input-style {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            outline: none;
            transition: all 0.3s ease;
        }
        
        /* Focus state match with Yellow theme */
        .input-style:focus {
            border-color: #ffbc06;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(255, 188, 6, 0.1);
        }
    </style>
</head>
<body class="auth-bg min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-[30px] shadow-2xl overflow-hidden my-10">
        
        <div class="h-2 bg-educenter-yellow w-full"></div>

        <div class="p-10">
            <div class="text-center mb-8">
                <h2 class="text-4xl font-black text-gray-800 italic tracking-tighter">edu<span class="text-educenter-yellow">center</span></h2>
                <p class="text-gray-500 mt-2 font-semibold">Join our community of learners</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{url('register_process')}}" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Axita Gondaliya" required class="input-style bg-gray-50">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-gray-400 text-sm font-bold border-r pr-2 border-gray-200">+91</span>
                        </div>
                        <input type="tel" name="mobileno" value="{{ old('mobileno') }}" placeholder="9876543210" pattern="[0-9]{10}" required class="input-style bg-gray-50 pl-16">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="axita@gmail.com" required class="input-style bg-gray-50">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder="*******" required class="input-style bg-gray-50 pr-12">
                        
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-educenter-navy transition-colors focus:outline-none">
                            <i id="eyeIcon" class="fas fa-eye text-lg"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Register As</label>
                    <div class="relative">
                        <select name="user_type" class="input-style bg-gray-50 cursor-pointer appearance-none pr-10">
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <!-- <option value="admin">Administrator</option> -->
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-educenter-yellow hover:bg-yellow-500 text-white font-extrabold py-4 rounded-2xl shadow-xl shadow-yellow-500/20 transition-all transform hover:-translate-y-1 active:scale-95 mt-4 tracking-widest">
                    CREATE ACCOUNT
                </button>
            </form>

            <div class="mt-8 text-center text-sm font-medium text-gray-500">
                Already part of Educenter? 
                <a href="{{ url('login') }}" class="text-educenter-yellow font-bold hover:underline ml-1">Login here</a>
            </div>
        </div>

        <div class="bg-gray-50 py-5 text-center text-[10px] text-gray-400 font-bold uppercase tracking-widest border-t border-gray-100">
            &copy; 2026 Educenter Learning Hub.
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>