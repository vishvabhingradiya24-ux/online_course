<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap');

        body { font-family: 'Outfit', sans-serif; background-color: #f0f4f8; color: #1e1e4b; }
        .bg-edu-navy { background-color: #1e1e4b; }
        .bg-edu-yellow { background-color: #ffbc06; }

        .curved-header {
            background-color: #1e1e4b;
            border-radius: 0 0 50px 50px;
            padding-bottom: 80px;
        }

        .nav-tab {
            padding: 12px 24px;
            border-radius: 15px;
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            transition: all 0.3s;
        }
        .nav-tab:hover, .nav-tab.active {
            background: #ffbc06;
            color: #1e1e4b;
        }

        .floating-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(30, 30, 75, 0.05);
            margin-top: -60px;
            transition: transform 0.3s ease;
        }
        .floating-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

    <header class="curved-header w-full px-10 pt-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-edu-yellow rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-navy text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-black text-white italic tracking-tighter">edu<span class="text-gray-400">center</span></h1>
                </div>

                <div class="flex items-center space-x-6 text-white">
                    <div class="text-right hidden md:block">
                       
                        <p class="text-[10px] text-edu-yellow font-bold uppercase tracking-widest">Faculty Member</p>
                    </div>
                   <a href="{{ url('teacher/profile') }}" class="group">
    <div class="w-12 h-12 bg-white/10 rounded-2xl overflow-hidden border border-white/20 group-hover:border-edu-yellow transition-all duration-300">
        @php

            $teacherPhoto = Auth::user()->profile_photo
                ? asset('uploads/profile/' . Auth::user()->profile_photo) . '?t=' . time()
                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=ffbc06&color=1e1e4b';
        @endphp

        <img src="{{ $teacherPhoto }}"
             alt="Profile"
             class="w-full h-full object-cover">
    </div>
</a>
                    <a href="{{ url('logout') }}" class="text-red-400 hover:text-red-300 text-xl">
                        <i class="fas fa-power-off"></i>
                    </a>
                </div>
            </div>

            <nav class="flex space-x-4 pb-4">
                <a href="{{url('teacher/dashboard')}}" class="nav-tab {{ request()->routeIs('teacherPanal.dashboard') ? 'active' : '' }}">Dashboard</a>

                <a href="{{url('teacher/courses/coursesList')}}" class="nav-tab {{ request()->routeIs('teacherPanal.courses.coursesList') ? 'active' : '' }}">My Courses</a>

                <a href="{{url('teacher/assignments/assignmentList')}}" class="nav-link {{ request()->routeIs('teacherPanal.assignments.assignmentList') ? 'active' : '' }} nav-tab">Assignments</a>

                <a href="{{url('teacher/reports/reports')}}" class="nav-tab {{ request()->routeIs('teacher.reports.reports') ? 'active' : '' }}">Reports</a>

            </nav>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <main class="max-w-7xl mx-auto px-6 pb-20">
        @yield('content')
    </main>

</body>
</html>
