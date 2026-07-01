<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap');
        
        body { font-family: 'Outfit', sans-serif; background-color: #f8faff; color: #1e1e4b; }
        .bg-edu-navy { background-color: #1e1e4b; }
        .bg-edu-yellow { background-color: #ffbc06; }
        .text-edu-navy { color: #1e1e4b; }
        
        .nav-link {
            transition: all 0.3s;
            margin: 5px 15px;
            border-radius: 12px;
            color: #94a3b8;
            font-weight: 600;
        }

        .nav-link:hover {
            background-color: rgba(255, 188, 6, 0.2);
            color: #ffbc06;
            transform: translateX(5px);
        }

        .nav-link.active {
            background-color: #ffbc06 !important;
            color: #1e1e4b !important;
        }

        /* Profile Image Styles */
        .profile-box {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #1e1e4b;
            color: white;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(30, 30, 75, 0.15);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <aside class="w-64 bg-edu-navy text-white flex flex-col shrink-0">
        <div class="p-8 mb-4">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-edu-yellow rounded shadow-lg shadow-yellow-500/20"></div>
                <h2 class="text-xl font-bold italic tracking-tighter">edu<span class="text-gray-400">center</span></h2>
            </div>
            <p class="text-[9px] font-bold text-gray-500 uppercase tracking-[3px] mt-3">Admin Control</p>
        </div>

        <nav class="flex-1 space-y-1">
            <a href="{{url('admin/dashboard')}}" class="nav-link flex items-center p-4 {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large w-8 text-lg"></i> Overview
            </a>

            <a href="{{url('admin/students')}}" class="nav-link flex items-center p-4 {{ Request::is('admin/students*') ? 'active' : '' }}">
                <i class="fas fa-user-graduate w-8 text-lg"></i> Students
            </a>

            <a href="{{url('admin/teachers')}}" class="nav-link flex items-center p-4 {{ Request::is('admin/teachers*') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher w-8 text-lg"></i> Teachers
            </a>

            <a href="{{url('admin/category')}}" class="nav-link flex items-center p-4 {{ Request::is('admin/category*') ? 'active' : '' }}">
                <i class="fas fa-layer-group w-8 text-lg"></i> Categories
            </a>

            <a href="{{ url('admin/courses') }}" class="nav-link flex items-center p-4 {{ Request::is('admin/courses*') ? 'active' : '' }}">
                <i class="fas fa-book-open w-8 text-lg"></i>
                <span>All Courses</span>
            </a>
        </nav>

        <div class="p-8 mt-auto">
            <a href="{{ url('logout') }}" class="flex items-center space-x-3 text-red-400 font-bold text-xs hover:text-red-300 transition">
                <i class="fas fa-sign-out-alt"></i>
                <span>SIGN OUT</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10">
            <h1 class="text-lg font-bold text-edu-navy tracking-tight">Management Console</h1>
            
            <div class="flex items-center space-x-4">
                <a href="{{ url('admin/profile') }}" class="group flex items-center space-x-3">
                    <div class="text-right hidden md:block">
                        <p class="text-xs font-bold text-edu-navy leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">Administrator</p>
                    </div>

                    <div class="profile-box group-hover:ring-2 group-hover:ring-edu-yellow group-hover:ring-offset-2 transition-all">
                        @if(Auth::user()->profile_photo && file_exists(public_path('uploads/profile/'.Auth::user()->profile_photo)))
                            <img src="{{ asset('uploads/profile/'.Auth::user()->profile_photo) }}?v={{ time() }}" 
                                 alt="Profile" 
                                 class="w-full h-full object-cover">
                        @else
                            <span>{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        @endif
                    </div>
                </a>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto scroll-smooth">
            @yield('content')
        </div>
    </main>

</body>
</html>