@extends('admin.dashboard')

@section('content')

<style>
    .content-wrapper, .main-panel, main {
        overflow-y: auto !important;
        height: auto !important;
        min-height: 100vh !important;
    }
  
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
</style>

<div class="w-full min-h-full p-4 md:p-8 bg-[#f8fafc] pb-24">
    
    <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Main Dashboard</h1>
            <!-- <p class="text-[11px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1">LJU Course Management</p> -->
        </div>
        <div class="bg-white px-5 py-2.5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">{{ date('D, d M Y') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        @php
            $stats = [
                ['label' => 'Total Students', 'value' => $total_students ?? '1,482', 'icon' => 'fa-user-graduate', 'color' => 'blue-600', 'bg' => 'blue-50'],
                ['label' => 'Total Courses', 'value' => $total_courses ?? '45', 'icon' => 'fa-book-open', 'color' => 'orange-500', 'bg' => 'orange-50'],
                ['label' => 'Total Teachers', 'value' => $total_teachers ?? '28', 'icon' => 'fa-chalkboard-teacher', 'color' => 'green-500', 'bg' => 'green-50'],
                ['label' => 'Active Now', 'value' => $activeCoursesCount ?? '0', 'icon' => 'fa-signal', 'color' => 'purple-600', 'bg' => 'purple-50']
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white p-6 rounded-[28px] border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300">
            <div class="w-12 h-12 bg-{{ $stat['bg'] }} text-{{ $stat['color'] }} rounded-2xl flex items-center justify-center mb-4">
                <i class="fas {{ $stat['icon'] }} text-lg"></i>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $stat['label'] }}</p>
            <h4 class="text-3xl font-black text-slate-900 mt-1">{{ $stat['value'] }}</h4>
        </div>

        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
        
        <div class="bg-white rounded-[35px] shadow-sm border border-gray-100 flex flex-col overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-white/50">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Recent Students</h3>
                <a href="{{ url('admin/students') }}" class="text-[10px] font-black text-blue-600 bg-blue-50 px-5 py-2 rounded-xl hover:bg-blue-600 hover:text-white transition-all uppercase tracking-widest">View All</a>
            </div>
            
            <div class="p-8 flex-1">
                <div class="space-y-6">
                    @forelse($recent_students as $student)
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-[20px] overflow-hidden shadow-md border-4 border-white ring-1 ring-gray-100">
                                @if($student->profile_photo && file_exists(public_path('uploads/profile/'.$student->profile_photo)))
                                    <img src="{{ asset('uploads/profile/'.$student->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name) }}&background=1e1e4b&color=ffbc06&bold=true" class="w-full h-full object-cover">
                                @endif
                            </div>

                            <div>
                                <p class="text-sm font-black text-slate-900 group-hover:text-blue-600 transition-colors">{{ $student->name }}</p>
                                <p class="text-[11px] text-gray-400 font-bold italic">{{ $student->email }}</p>
                            </div>

                        </div>
                        <a href="{{ url('admin/student/studentDetails/'.$student->id) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-gray-400 hover:bg-blue-600 hover:text-white transition-all">
                            <i class="fas fa-chevron-right text-[10px]"></i>
                        </a>

                    </div>
                    @empty
                    <p class="text-center py-10 text-gray-400 font-bold italic">No records found.</p>
                    @endforelse

                </div>
            </div>
        </div>

        <div class="bg-white rounded-[35px] shadow-sm border border-gray-100 flex flex-col overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-white/50">
                <h3 class="text-lg font-black text-slate-900 tracking-tight">New Faculty</h3>
                <a href="{{ url('admin/teachers') }}" class="text-[10px] font-black text-green-600 bg-green-50 px-5 py-2 rounded-xl hover:bg-green-600 hover:text-white transition-all uppercase tracking-widest">View All</a>
            </div>
            
            <div class="p-8 flex-1">
                <div class="space-y-6">
                    @forelse($recent_teachers as $teacher)
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-[20px] overflow-hidden shadow-md border-4 border-white ring-1 ring-gray-100">
                                @if($teacher->profile_photo && file_exists(public_path('uploads/profile/'.$teacher->profile_photo)))
                                    <img src="{{ asset('uploads/profile/'.$teacher->profile_photo) }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}&background=10b981&color=ffffff&bold=true" class="w-full h-full object-cover">
                                @endif
                            </div>

                            <div>
                                <p class="text-sm font-black text-slate-900 group-hover:text-green-600 transition-colors">{{ $teacher->name }}</p>
                                <p class="text-[11px] text-gray-400 font-bold italic">{{ $teacher->email }}</p>
                            </div>

                        </div>
                        <a href="{{ url('admin/teacher/teacherDetails/'.$teacher->id) }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-gray-400 hover:bg-green-600 hover:text-white transition-all">
                            <i class="fas fa-chevron-right text-[10px]"></i>
                        </a>

                    </div>
                    @empty
                    <p class="text-center py-10 text-gray-400 font-bold italic">No records found.</p>
                    @endforelse

                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection