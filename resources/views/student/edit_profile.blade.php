<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Educenter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&display=swap');
        :root { --educenter-blue: #1e1e4b; --educenter-yellow: #ffbc06; }
        body { font-family: 'Outfit', sans-serif; background-color: #f8f9fa; }
        .bg-navy { background-color: var(--educenter-blue); }
        .text-yellow-main { color: var(--educenter-yellow); }
        .bg-yellow-main { background-color: var(--educenter-yellow); }
        .text-navy { color: var(--educenter-blue); }
        
        .modal-active { display: flex !important; animation: fadeIn 0.2s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <div class="bg-[#1e1e4b] pb-32 pt-10 px-10 rounded-b-[50px] shadow-lg">
        <div class="max-w-3xl mx-auto flex items-center relative">
            <a href="{{ url('student/profile') }}" 
               class="absolute left-0 w-10 h-10 flex items-center justify-center rounded-xl bg-white/10 text-white hover:bg-[#ffbc06] hover:text-[#1e1e4b] transition-all duration-300 shadow-md">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <h2 class="w-full text-center text-2xl font-black text-white italic tracking-tight">
                Update <span class="text-[#ffbc06]">Information</span>
            </h2>
        </div>
    </div> 

    <div class="max-w-3xl mx-auto px-10 -mt-20 mb-20">
        <div class="bg-white rounded-[40px] p-10 shadow-2xl border border-gray-50">
            
            <form action="{{ url('student/update-profile') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <div class="flex flex-col items-center mb-10">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-[35px] border-4 border-yellow-main p-1 shadow-xl overflow-hidden bg-gray-50">
                            <img id="previewImg" 
                                 src="{{ Auth::user()->profile_photo ? asset('uploads/profile/' . Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=1e1e4b&color=ffbc06&size=200' }}" 
                                 class="w-full h-full rounded-[28px] object-cover"
                                 alt="Profile Photo">
                        </div>
                        
                        <div onclick="togglePhotoMenu()" class="absolute -bottom-2 -right-2 bg-navy text-yellow-main w-10 h-10 rounded-xl flex items-center justify-center cursor-pointer shadow-lg hover:scale-110 transition-all border-2 border-white">
                            <i class="fas fa-camera text-sm"></i>
                        </div>
                    </div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-4">Change Profile Photo</p>
                </div>

                <input type="file" id="cameraInput" name="profile_photo" class="hidden" accept="image/*" capture="environment" onchange="previewFile(this)">
                <input type="file" id="galleryInput" name="profile_photo" class="hidden" accept="image/*" onchange="previewFile(this)">
                
                <input type="hidden" id="removePhotoFlag" name="remove_photo" value="0">

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">Full Name</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" 
                               class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl outline-none focus:border-yellow-main font-bold text-navy transition shadow-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">Mobile Number</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400">
                            <i class="fas fa-phone-alt"></i>
                        </span>
                        <input type="text" name="mobileno" value="{{ Auth::user()->mobileno }}" 
                               class="w-full pl-14 pr-6 py-4 bg-gray-50 border-2 border-gray-100 rounded-2xl outline-none focus:border-yellow-main font-bold text-navy transition shadow-sm">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="flex-1 bg-yellow-main text-navy font-black py-4 rounded-2xl shadow-lg hover:scale-[1.02] active:scale-95 transition-all">
                        SAVE CHANGES
                    </button>
                    <a href="{{ url('student/profile') }}" 
                       class="flex-1 bg-gray-100 text-gray-400 font-black py-4 rounded-2xl text-center hover:bg-gray-200 transition-all flex items-center justify-center">
                        CANCEL
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div id="photoMenu" class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-6 backdrop-blur-sm" onclick="togglePhotoMenu()">
        <div class="bg-white w-full max-w-sm rounded-[40px] overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-200" onclick="event.stopPropagation()">
            <div class="p-8 space-y-3">
                <h4 class="text-center text-navy font-black italic text-xl mb-6">Profile Photo</h4>
                
                <button type="button" onclick="document.getElementById('cameraInput').click(); togglePhotoMenu();" 
                        class="w-full flex items-center gap-4 p-5 bg-gray-50 rounded-2xl hover:bg-[#ffbc06] group transition-all duration-300">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-navy group-hover:bg-[#1e1e4b] group-hover:text-[#ffbc06] transition-all">
                        <i class="fas fa-camera"></i>
                    </div>
                    <span class="font-bold text-navy">Take Photo</span>
                </button>

                <button type="button" onclick="document.getElementById('galleryInput').click(); togglePhotoMenu();" 
                        class="w-full flex items-center gap-4 p-5 bg-gray-50 rounded-2xl hover:bg-[#ffbc06] group transition-all duration-300">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-navy group-hover:bg-[#1e1e4b] group-hover:text-[#ffbc06] transition-all">
                        <i class="fas fa-images"></i>
                    </div>
                    <span class="font-bold text-navy">Choose from Gallery</span>
                </button>

                <button type="button" onclick="removePhoto(); togglePhotoMenu();" 
                        class="w-full flex items-center gap-4 p-5 bg-red-50 rounded-2xl hover:bg-red-500 group transition-all duration-300">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-red-500 group-hover:bg-white group-hover:text-red-500 transition-all">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <span class="font-bold text-red-600 group-hover:text-white">Remove Photo</span>
                </button>

                <button type="button" onclick="togglePhotoMenu()" class="w-full py-4 text-gray-400 font-bold uppercase tracking-widest text-xs mt-4">Close</button>
            </div>
        </div>
    </div>

    <script>
        function togglePhotoMenu() {
            const menu = document.getElementById('photoMenu');
            menu.classList.toggle('hidden');
            menu.classList.toggle('modal-active');
        }

        function previewFile(input) {
            const preview = document.getElementById('previewImg');
            const file = input.files[0];
            const reader = new FileReader();
            
            document.getElementById('removePhotoFlag').value = "0";

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function removePhoto() {
            const preview = document.getElementById('previewImg');
            const defaultAvatar = "https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1e1e4b&color=ffbc06&size=200";
            
            preview.src = defaultAvatar;
            document.getElementById('removePhotoFlag').value = "1";
            document.getElementById('galleryInput').value = "";
            document.getElementById('cameraInput').value = "";
        }
    </script>

</body>
</html>