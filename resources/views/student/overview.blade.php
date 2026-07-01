<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --educenter-blue: #1e1e4b;
            --educenter-yellow: #ffbc06;
        }

        .bg-navy { background-color: var(--educenter-blue); }
        .bg-yellow-main { background-color: var(--educenter-yellow); }
        .text-yellow-main { color: var(--educenter-yellow); }

        .sidebar-item:hover {
            background: rgba(255, 188, 6, 0.1);
            color: var(--educenter-yellow);
        }

        .active-link {
            background: var(--educenter-yellow);
            color: white !important;
        }
    </style>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-72 bg-navy text-white flex flex-col shadow-2xl">
        <div class="p-8 border-b border-gray-700">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-yellow-main rounded-sm mr-2 transform rotate-12"></div>
                <h2 class="text-2xl font-black italic tracking-tighter">
                    edu<span class="text-gray-400">center</span>
                </h2>
            </div>
            <p class="text-[10px] uppercase tracking-[3px] text-yellow-main mt-2 font-bold">
                Student Portal
            </p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2">

            <a href="{{ url('student/dashboard') }}" class="sidebar-item active-link flex items-center p-3 rounded-xl transition font-bold">
                <i class="fas fa-th-large w-6"></i> Dashboard
            </a>

            <a href="{{ route('student.courses') }}" class="sidebar-item flex items-center p-3 rounded-xl transition font-medium text-gray-400">
                <i class="fas fa-play-circle w-6"></i> My Courses
            </a>

            <a href="{{ url('student/assignments') }}" class="sidebar-item flex items-center p-3 rounded-xl transition font-medium text-gray-400">
                <i class="fas fa-file-alt w-6"></i> Assignments
            </a>

            <!-- Home Button Added -->
            <a href="{{ url('/') }}" class="sidebar-item flex items-center p-3 rounded-xl transition font-medium text-gray-400">
                <i class="fas fa-home w-6"></i> Home
            </a>

        </nav>

        <!-- Logout -->
        <div class="p-6 border-t border-gray-700">
            <a href="{{ url('logout') }}" class="flex items-center p-3 text-red-400 hover:bg-red-500/10 rounded-xl transition font-bold">
                <i class="fas fa-sign-out-alt w-6"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 flex flex-col overflow-y-auto">

        <!-- Header -->
        <header class="bg-white h-20 shadow-sm flex items-center justify-between px-10 border-b">
            

            {{-- <div class="flex items-center space-x-6">
                <div class="relative">
                    <i class="fas fa-bell text-gray-400 text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 w-2 h-2 rounded-full border-2 border-white"></span>
                </div> --}}

                <div class="h-10 w-[1px] bg-gray-200"></div>

                <a href="{{ url('student/profile') }}" class="flex items-center group cursor-pointer hover:bg-gray-50 p-2 rounded-2xl transition-all">
                    <div class="text-right mr-3">
                        <p class="text-xs font-bold text-gray-400 uppercase">Welcome back</p>
                        <p class="text-sm font-black" style="color: #1e1e4b;">
                            {{ Auth::user()->name ?? 'Guest' }}
                        </p>
                    </div>

                    <div class="h-11 w-11 rounded-xl shadow-md border-2 border-yellow-main overflow-hidden group-hover:border-navy transition-all">
                        @if(Auth::user()->profile_photo && file_exists(public_path('uploads/profile/'.Auth::user()->profile_photo)))
                            <img src="{{ asset('uploads/profile/'.Auth::user()->profile_photo) }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1e1e4b&color=ffbc06&bold=true" class="w-full h-full object-cover">
                        @endif
                    </div>
                </a>
            </div>
        </header>

        @yield('content')
    </main>

</body>
</html>
