<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Profile | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; background-color: #f3f4f6; }
        .bg-navy { background-color: #1e1e4b; }
        .text-yellow { color: #ffbc06; }
        .bg-yellow { background-color: #ffbc06; }
    </style>
</head>
<body>

    <div class="bg-navy pb-32 pt-8 px-10 rounded-b-[50px]">
        <div class="flex justify-between items-center max-w-5xl mx-auto">
            <div class="flex items-center gap-2">
                <a href="{{ url('teacher/dashboard') }}" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-yellow group transition-all mr-2 shadow-lg">
                    <i class="fas fa-arrow-left text-white group-hover:text-navy"></i>
                </a>
                <h2 class="text-2xl font-black italic text-white tracking-tighter">My <span class="text-yellow">Profile</span></h2>
            </div>
            
            <div class="text-white/40 text-[10px] font-bold uppercase tracking-[4px]">Faculty Portal</div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-10 -mt-20 mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="bg-white rounded-[40px] p-8 shadow-xl text-center border border-gray-50">
                <div class="relative w-32 h-32 mx-auto mb-6">
                    <div class="w-full h-full bg-gray-50 rounded-[35px] border-4 border-yellow p-1 flex items-center justify-center overflow-hidden shadow-inner">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('uploads/profile/' . Auth::user()->profile_photo) }}?t={{ time() }}" 
                                 class="w-full h-full rounded-[28px] object-cover" 
                                 alt="Profile Photo">
                        @else
                            <div class="w-full h-full rounded-[28px] bg-gray-100 flex items-center justify-center">
                                <span class="text-4xl font-black text-navy uppercase">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <a href="{{ url('teacher/edit_profile') }}" 
                       class="absolute -bottom-2 -right-2 bg-white p-1.5 rounded-xl shadow-lg hover:scale-110 transition-all duration-300 group">
                        <div class="bg-navy w-8 h-8 rounded-lg flex items-center justify-center group-hover:bg-yellow transition-colors border-2 border-white">
                            <i class="fas fa-pencil-alt text-yellow text-[10px] group-hover:text-navy"></i>
                        </div>
                    </a>
                </div>
                
                <h3 class="text-2xl font-black text-navy italic tracking-tight">{{ Auth::user()->name }}</h3>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">
                    {{ Auth::user()->user_type }} Member
                </p>
                
                <div class="mt-8 space-y-3">
                    <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm text-yellow">
                            <i class="fas fa-envelope text-xs"></i>
                        </div>
                        <span class="text-xs font-bold text-navy truncate">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="flex items-center gap-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm text-yellow">
                            <i class="fas fa-phone-alt text-xs"></i>
                        </div>
                        <span class="text-xs font-bold text-navy">{{ Auth::user()->mobileno ?? 'Not Set' }}</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-[40px] p-10 shadow-xl border border-gray-50">
                    <div class="flex items-center gap-3 mb-8 border-b pb-4">
                        <i class="fas fa-id-card text-yellow"></i>
                        <h4 class="text-xl font-black text-navy italic">Personal Information</h4>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Full Name</p>
                            <p class="font-bold text-navy">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Official Email</p>
                            <p class="font-bold text-navy">{{ Auth::user()->email }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Mobile Number</p>
                            <p class="font-bold text-navy">{{ Auth::user()->mobileno ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Role / User Type</p>
                            <p class="font-bold text-navy capitalize">{{ Auth::user()->user_type }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Registration Date</p>
                            <p class="font-bold text-navy">{{ Auth::user()->created_at->format('d M, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">University Status</p>
                            <span class="bg-green-100 text-green-600 text-[9px] font-black px-3 py-1 rounded-full uppercase">Verified Faculty</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[40px] p-10 shadow-xl border border-gray-50">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-info-circle text-yellow"></i>
                        <h4 class="text-xl font-black text-navy italic">About Faculty</h4>
                    </div>
                    <p class="text-sm text-gray-500 font-medium leading-relaxed italic">
                        "Welcome to your profile. As a registered {{ Auth::user()->user_type }} at Educenter, you have access to manage courses, track student progress, and post updates to the dashboard."
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="text-center pb-10">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">&copy; 2026 Educenter - MCA Project</p>
    </div>

</body>
</html>