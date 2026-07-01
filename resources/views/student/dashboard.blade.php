@extends('student.overview')

@section('content')

<div class="p-10">

    <!-- Hero Banner -->
    <div class="bg-navy rounded-[40px] p-10 relative overflow-hidden mb-10 shadow-xl">
        <div class="relative z-10 text-white max-w-lg">
            <h2 class="text-4xl font-black leading-tight mb-4">
                Your bright future is our mission
            </h2>

            <p class="text-gray-300 mb-6 italic text-sm">
                "Success is not final; failure is not fatal: it is the courage to continue that counts."
            </p>
        </div>

        <div class="absolute -right-20 -top-20 w-80 h-80 bg-yellow-main opacity-20 rounded-full"></div>
        <div class="absolute right-20 bottom-10 w-20 h-20 border-4 border-yellow-main opacity-30 rounded-full"></div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

        <div class="bg-white p-8 rounded-[30px] shadow-sm border border-gray-100 hover:shadow-md transition group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 font-bold text-xs uppercase mb-1">Total Progress</p>
                    <h3 class="text-3xl font-black text-navy">{{ $progress }}%</h3>
                </div>
                <div class="w-14 h-14 bg-blue-50 text-navy rounded-2xl flex items-center justify-center group-hover:bg-navy group-hover:text-white transition">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[30px] shadow-sm border border-gray-100 hover:shadow-md transition group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 font-bold text-xs uppercase mb-1">Courses In Hand</p>
                    <h3 class="text-3xl font-black text-navy">{{ $totalCourses }}</h3>
                </div>
                <div class="w-14 h-14 bg-yellow-50 text-yellow-main rounded-2xl flex items-center justify-center group-hover:bg-yellow-main group-hover:text-white transition">
                    <i class="fas fa-graduation-cap text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Enrolled Courses -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        @forelse($courses as $c)

            @php
                $courseProgress = $c->last_watched_video ? 100 : 0;
            @endphp

            <div class="bg-white rounded-[35px] p-6 shadow-sm border flex items-center group hover:shadow-lg transition">

                <div class="w-32 h-32 rounded-[25px] overflow-hidden mr-6 shadow-md">
                    @if($c->course->image)
                        <img src="{{ asset('uploads/course_images/'.$c->course->image) }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=200" class="w-full h-full object-cover">
                    @endif
                </div>

                <div class="flex-1">
                    <span class="text-[10px] font-black uppercase text-yellow-main bg-yellow-50 px-3 py-1 rounded-full mb-2 inline-block">
                        Course
                    </span>

                    <h4 class="text-lg font-black text-navy mb-3">
                        {{ $c->course->title ?? 'No Title' }}
                    </h4>

                    <div class="flex items-center mb-4">
                        <div class="flex-1 h-2 bg-gray-100 rounded-full mr-4">
                            <div class="bg-yellow-main h-full rounded-full" style="width: {{ $courseProgress }}%"></div>
                        </div>

                        <span class="text-xs font-bold text-gray-400">
                            {{ $courseProgress }}%
                        </span>
                    </div>

                    <a href="{{ url('student/course/'.$c->course->id.'/start') }}"
                       class="bg-navy text-white px-4 py-2 rounded-full text-sm font-bold hover:bg-yellow-main transition">
                        Start Learning
                    </a>
                </div>
            </div>

        @empty
            <p>No Courses Found</p>
        @endforelse

    </div>

</div>

@endsection