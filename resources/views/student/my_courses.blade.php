@extends('student.overview')

@section('content')

<div class="container mt-4">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-black text-navy">My Enrolled Courses</h2>
        <span class="bg-navy text-white px-4 py-1 rounded-full text-xs font-bold">
            Total: {{ $enrolledCourses->count() }}
        </span>
    </div>

    <div class="row grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($enrolledCourses as $enroll)
            <div class="col-md-4">
                <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group h-full flex flex-col">
                    
                    <div class="relative h-48 overflow-hidden">
                        @php
                            $videos = json_decode($enroll->course->video, true);
                        @endphp

                        @if(!empty($videos[0]))
                            <video class="w-full h-full object-cover" controls>
                                <source src="{{ asset('videos/' . $videos[0]) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=500"
                                class="w-full h-full object-cover">
                        @endif

                       
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-2">
                            <i class="far fa-calendar-alt mr-1"></i> Enrolled: {{ $enroll->created_at->format('M d, Y') }}
                        </p>
                        
                        <h5 class="text-xl font-black text-navy mb-3 line-clamp-1">
                            {{ $enroll->course->course_name }}
                        </h5>
                        
                        <p class="text-gray-500 text-sm mb-6 flex-1">
                            {{ Str::limit($enroll->course->description, 90) }}
                        </p>

                        <a href="{{ url('student/course/view/' . $enroll->course->id) }}" 
                           class="inline-flex items-center justify-center w-full bg-navy text-white font-bold py-3 rounded-2xl hover:bg-yellow-main hover:text-navy transition-colors duration-300 shadow-lg">
                            <i class="fas fa-play-circle mr-2"></i> Start Learning
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="bg-white p-12 rounded-[40px] shadow-sm border border-dashed border-gray-200 inline-block max-w-lg">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-graduation-cap text-3xl text-gray-300"></i>
                    </div>
                    <h4 class="text-2xl font-black text-navy mb-2">No courses joined yet</h4>
                    <p class="text-gray-400 mb-8">You haven't enrolled in any courses. Explore our catalog to start your learning journey.</p>
                    <a href="{{ url('course') }}" class="bg-yellow-main text-navy font-black px-10 py-4 rounded-full hover:scale-105 transition shadow-lg">
                        Browse Catalog
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection