<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap');
        :root {
            --educenter-blue: #1e1e4b;
            --educenter-yellow: #ffbc06;
        }
        body { font-family: 'Outfit', sans-serif; background-color: #f8f9fa; }
        .bg-navy { background-color: var(--educenter-blue); }
        .text-yellow-main { color: var(--educenter-yellow); }
        .bg-yellow-main { background-color: var(--educenter-yellow); }
    </style>
</head>
<body>

    <div class="bg-navy pb-32 pt-10 px-10 rounded-b-[60px] shadow-2xl">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ url('student/dashboard') }}" class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-yellow-main group transition-all shadow-lg">
                    <i class="fas fa-chevron-left text-white group-hover:text-navy"></i>
                </a>
                <h2 class="text-3xl font-black italic text-white tracking-tighter">My <span class="text-yellow-main">Profile</span></h2>
            </div>
            <div class="text-white/50 text-[10px] font-bold uppercase tracking-[4px]">Student Portal</div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-10 -mt-20 mb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="bg-white rounded-[45px] p-10 shadow-xl border border-gray-50 text-center">
                <div class="relative w-40 h-40 mx-auto mb-6">
                    <div class="w-full h-full rounded-[40px] border-4 border-yellow-main p-1 shadow-inner overflow-hidden bg-gray-50">
                        @php
                           
                            $photoPath = Auth::user()->profile_photo
                                ? asset('uploads/profile/' . Auth::user()->profile_photo) . '?t=' . time()
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=1e1e4b&color=ffbc06&size=200';
                        @endphp
                        <img src="{{ $photoPath }}"
                             class="w-full h-full rounded-[35px] object-cover"
                             alt="Profile Photo">
                    </div>

                    <a href="{{ url('student/edit_profile') }}"
                       class="absolute -bottom-2 -right-2 bg-white p-2 rounded-2xl shadow-lg hover:scale-110 transition-all duration-300 group">
                        <div class="bg-navy w-10 h-10 rounded-xl flex items-center justify-center group-hover:bg-yellow-main transition-colors border-2 border-white shadow-md">
                            <i class="fas fa-pencil-alt text-yellow-main text-xs group-hover:text-navy"></i>
                        </div>
                    </a>
                </div>

                <h3 class="text-2xl font-black text-navy italic tracking-tight">{{ Auth::user()->name }}</h3>
                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mt-2 bg-gray-50 inline-block px-4 py-1 rounded-full">
                    {{ Auth::user()->user_type }}
                </p>

                <div class="mt-10 space-y-4">
                    <div class="flex items-center gap-4 bg-gray-50 p-5 rounded-[25px] border border-gray-100 group hover:border-yellow-main transition">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-yellow-main">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="text-left overflow-hidden">
                            <p class="text-[9px] font-bold text-gray-400 uppercase">Email Address</p>
                            <p class="text-xs font-bold text-navy truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 bg-gray-50 p-5 rounded-[25px] border border-gray-100 group hover:border-yellow-main transition">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-yellow-main">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[9px] font-bold text-gray-400 uppercase">Mobile Number</p>
                            <p class="text-xs font-bold text-navy">{{ Auth::user()->mobileno ?? 'Not Set' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white rounded-[45px] p-12 shadow-xl border border-gray-50">
                    <div class="flex items-center justify-between mb-10 border-b border-gray-100 pb-6">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-user-circle text-yellow-main text-2xl"></i>
                            <h4 class="text-xl font-black text-navy italic">General Information</h4>
                        </div>
                        @if(session('success'))
                            <span class="text-green-500 font-bold text-xs bg-green-50 px-3 py-1 rounded-full border border-green-100">
                                <i class="fas fa-check-circle mr-1"></i> Updated
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-10 gap-x-6">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[2px] mb-2">Student Name</p>
                            <p class="font-bold text-navy text-lg">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[2px] mb-2">Registration ID</p>
                            <p class="font-bold text-navy text-lg">#STU-00{{ Auth::user()->id }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[2px] mb-2">Joined Date</p>
                            <p class="font-bold text-navy text-lg">{{ Auth::user()->created_at->format('d M, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[2px] mb-2">Status</p>
                            <span class="inline-block bg-green-100 text-green-600 text-[10px] font-black px-4 py-1 rounded-full uppercase">Active Student</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-yellow-main rounded-[35px] p-8 shadow-lg shadow-yellow-200">
                        <i class="fas fa-graduation-cap text-navy text-3xl mb-4"></i>
                        <h5 class="text-navy font-black text-3xl">05</h5>
                        <p class="text-navy/60 font-bold text-xs uppercase tracking-widest">Enrolled Courses</p>
                    </div>
                    <div class="bg-white rounded-[35px] p-8 shadow-xl border border-gray-50">
                        <i class="fas fa-award text-yellow-main text-3xl mb-4"></i>
                        <h5 class="text-navy font-black text-3xl">12</h5>
                        <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Certificates</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="text-center py-10 opacity-30">
        <p class="text-[10px] font-black uppercase tracking-[5px] text-navy">Educenter Student Portal &copy; 2026</p>
    </div>

</body>
</html>
