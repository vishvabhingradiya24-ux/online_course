@extends('student.overview')

@section('content')

<div class="container mt-4">

    <!-- Heading -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-black text-navy">My Assignments</h2>

        <span class="bg-navy text-white px-4 py-2 rounded-full text-xs font-bold shadow">
            Total: {{ $assignments->count() }}
        </span>
    </div>

    <!-- Filter Buttons -->
    <div class="flex gap-3 mb-8">
        <a href="{{ url('student/assignments') }}"
           class="px-5 py-2 rounded-full font-bold shadow
           {{ !$status ? 'bg-navy text-white' : 'bg-white text-navy border' }}">
            All
        </a>

        <a href="{{ url('student/assignments?status=pending') }}"
           class="px-5 py-2 rounded-full font-bold shadow
           {{ $status == 'pending' ? 'bg-yellow-main text-navy' : 'bg-white text-navy border' }}">
            Pending
        </a>

        <a href="{{ url('student/assignments?status=complete') }}"
           class="px-5 py-2 rounded-full font-bold shadow
           {{ $status == 'complete' ? 'bg-green-500 text-white' : 'bg-white text-navy border' }}">
            Complete
        </a>
    </div>

    <!-- Assignment Cards -->
    <div class="row">
        @forelse($assignments as $assignment)

            @php
                $submission = $assignment->submissions->first();
            @endphp

            <div class="col-md-6 mb-4">
                <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 h-full">

                    <div class="p-6">

                        <!-- Header -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h4 class="text-xl font-black text-navy mb-2">
                                    {{ $assignment->title }}
                                </h4>

                                <p class="text-sm text-gray-500">
                                    {{ $assignment->course->title ?? 'N/A' }}
                                </p>
                            </div>

                            @if($submission)
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold">
                                    Completed
                                </span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                    Pending
                                </span>
                            @endif
                        </div>

                        <!-- Submission Date -->
                       <p class="text-gray-500 text-sm mb-4">
                            <strong>Submission Date:</strong>
                            {{ $submission ? \Carbon\Carbon::parse($submission->submitted_at)->format('d M Y') : 'Not Submitted' }}
                       </p>
                        <!-- Buttons -->
                        <div class="flex flex-wrap gap-3">

                            <!-- Download PDF -->
                            <a href="{{ url('student/download-submission/'.$submission->file) }}"
                            class="bg-blue-50 text-blue-700 px-4 py-2 rounded-full font-bold text-sm hover:scale-105 transition">
                                Download PDF
                            </a>

                            @if(!$submission)
                                <!-- Submit Assignment -->
                                <a href="{{ url('student/assignment/submit/'.$assignment->id) }}"
                                   class="bg-yellow-main text-navy px-4 py-2 rounded-full font-bold text-sm hover:scale-105 transition shadow">
                                    Submit Assignment
                                </a>
                            @else
                                <!-- View PDF -->
                                <a href="{{ asset('uploads/submissions/'.$submission->file) }}"
                                   target="_blank"
                                   class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold text-sm hover:scale-105 transition">
                                    View PDF
                                </a>
                            @endif

                        </div>
                    </div>

                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="bg-white rounded-[30px] p-10 text-center shadow-sm border border-dashed border-gray-200">
                    <h4 class="text-2xl font-black text-navy mb-2">No Assignments Found</h4>
                    <p class="text-gray-400">There are no assignments available right now.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>

@endsection