@extends('student.overview')

@section('content')

<div class="container mt-4">

    <div class="bg-white rounded-[30px] shadow-sm border border-gray-100 p-8 max-w-2xl">

        <h2 class="text-3xl font-black text-navy mb-6">
            Submit Assignment
        </h2>

        <form action="{{ url('student/assignment/upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-600 mb-2">
                    Upload PDF File
                </label>

                <input type="file"
                       name="file"
                       required
                       class="w-full border rounded-lg p-3">
            </div>

            <button type="submit"
                    class="bg-yellow-main text-navy px-6 py-3 rounded-full font-bold shadow hover:scale-105 transition">
                Upload Assignment
            </button>

        </form>
    </div>

</div>

@endsection