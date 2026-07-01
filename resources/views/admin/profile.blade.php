@extends('admin.dashboard') 

@section('content')
<div class="flex-1 overflow-y-auto p-10 pt-6">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-edu-navy italic tracking-tight">Admin <span class="text-edu-yellow">Profile</span></h2>
        <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mt-1">Manage your account settings</p>
    </div>

    <form action="{{ url('admin/update_profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-12 gap-8">
            
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <div class="bg-white rounded-[35px] p-8 shadow-xl border border-gray-50 text-center relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-edu-yellow/10 rounded-full"></div>
                    
                    <div class="relative w-32 h-32 mx-auto mb-6 group">
                        <div class="w-full h-full rounded-[30px] border-4 border-edu-yellow p-1 shadow-inner overflow-hidden bg-gray-50">
                            <img src="{{ Auth::user()->profile_photo ? asset('uploads/profile/'.Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=1e1e4b&color=ffbc06&size=200' }}" 
                                 class="w-full h-full rounded-[25px] object-cover" 
                                 alt="Admin Profile" id="profile-preview">
                        </div>
                        
                        <label for="photo-upload" class="absolute bottom-1 right-1 w-10 h-10 bg-edu-yellow text-edu-navy rounded-xl flex items-center justify-center cursor-pointer shadow-lg hover:bg-edu-navy hover:text-white transition-all duration-300 border-4 border-white">
                            <i class="fas fa-pencil-alt text-sm"></i>
                            <input type="file" id="photo-upload" name="profile_photo" class="hidden" onchange="previewImage(this)">
                        </label>
                    </div>

                    <h3 class="text-2xl font-black text-edu-navy">{{ Auth::user()->name }}</h3>
                    <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest mt-2 bg-gray-50 inline-block px-4 py-1 rounded-full">
                        System Administrator
                    </p>

                    <div class="mt-8 space-y-3">
                        <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm text-edu-yellow">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[9px] font-bold text-gray-400 uppercase">Email</p>
                                <p class="text-xs font-bold text-edu-navy">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-edu-navy rounded-[35px] p-8 text-white shadow-lg shadow-navy-200">
                    <div class="flex justify-between items-start mb-4">
                        <i class="fas fa-shield-alt text-edu-yellow text-2xl"></i>
                        <span class="text-[10px] font-bold bg-white/10 px-3 py-1 rounded-full">SECURE</span>
                    </div>
                    <h4 class="text-xl font-bold mb-1">Account Security</h4>
                    <p class="text-white/50 text-xs">Last login: {{ date('d M, Y H:i') }}</p>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8">
                <div class="bg-white rounded-[35px] p-10 shadow-xl border border-gray-50">
                    <div class="flex items-center gap-3 mb-10 border-b border-gray-100 pb-6">
                        <i class="fas fa-edit text-edu-yellow text-xl"></i>
                        <h4 class="text-xl font-black text-edu-navy italic">Edit Details</h4>
                    </div>

                    @if(session('success'))
                    <div class="bg-green-100 text-green-600 p-4 rounded-2xl mb-4 font-bold text-sm">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-2">Full Name</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" required
                                   class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl outline-none focus:border-edu-yellow font-bold text-edu-navy transition shadow-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-2">Email Address</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" required
                                   class="w-full px-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl outline-none focus:border-edu-yellow font-bold text-edu-navy transition shadow-sm">
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="bg-edu-yellow text-edu-navy font-black px-10 py-4 rounded-2xl shadow-lg shadow-yellow-200 hover:scale-[1.02] active:scale-95 transition-all w-full md:w-auto">
                            UPDATE PROFILE
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection