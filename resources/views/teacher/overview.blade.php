@extends('teacher.dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
    <div class="floating-card p-8">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Total Students</p>
        <div class="flex items-center justify-between">
            <h3 class="text-4xl font-black text-edu-navy">{{ number_format($totalStudents) }}</h3>
            <i class="fas fa-users text-edu-yellow text-2xl"></i>
        </div>
    </div>

    <div class="floating-card p-8">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Active Courses</p>
        <div class="flex items-center justify-between">
            <h3 class="text-4xl font-black text-edu-navy">{{ $liveCourses }}</h3>
            <i class="fas fa-book-reader text-edu-yellow text-2xl"></i>
        </div>
    </div>

    <div class="floating-card p-8">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Submissions</p>
        <div class="flex items-center justify-between">
             <h3 class="text-4xl font-black text-edu-navy">{{ $submissionsCount }}</h3> 
            <i class="fas fa-file-upload text-edu-yellow text-2xl"></i>
        </div>
    </div>

    <div class="floating-card p-8">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Avg. Grade</p>
        <div class="flex items-center justify-between">
            <h3 class="text-4xl font-black text-edu-navy">A+</h3>
            <i class="fas fa-star text-edu-yellow text-2xl"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 bg-white rounded-[40px] p-10 shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-8">
            <h4 class="text-2xl font-extrabold text-edu-navy">Recent Activity Log</h4>
            <a href="#" class="text-edu-yellow font-bold text-sm">View All</a>
        </div>

        <div class="space-y-6">
            @foreach($recentStudents as $student)
            <div class="flex items-center justify-between p-5 bg-gray-50 rounded-3xl border border-transparent hover:border-edu-yellow transition-all">
                <div class="flex items-center space-x-5">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center font-bold text-edu-navy shadow-sm text-lg">
                        {{ strtoupper(substr($student->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-lg font-bold text-edu-navy">{{ $student->name }}</p>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">
                            {{ $student->course_name ?? 'Student' }} - {{ $student->university ?? 'Educenter' }}
                        </p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="bg-green-100 text-green-600 text-[10px] font-bold px-4 py-2 rounded-full uppercase">
                        {{ $student->status ?? 'Verified' }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="space-y-8">
        <div class="bg-edu-yellow rounded-[40px] p-8 text-edu-navy shadow-xl shadow-yellow-500/20">
            <h4 class="text-xl font-black mb-4">Quick Notice</h4>
            <p class="text-sm font-medium leading-relaxed mb-6 italic">"The internal assessment for Laravel Framework is scheduled for coming Monday."</p>
            <button class="w-full bg-edu-navy text-white font-bold py-4 rounded-2xl text-sm">Post New Update</button>
        </div>

        <div class="bg-white rounded-[40px] p-8 border border-gray-100 shadow-sm">
            <h4 class="text-xl font-black text-edu-navy mb-6">Upcoming Classes</h4>
            
        </div>
    </div>
</div>

@endsection