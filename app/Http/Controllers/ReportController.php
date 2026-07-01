<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;

class ReportController extends Controller
{

    public function reports()
    {
        $courses = Course::with([
            'assignments.submissions',
            'studentDetails'
        ])->where('teacher_id', Auth::id())->get();

        $courseIds = $courses->pluck('id');
        $students = User::where('user_type', 'student')
        ->whereHas('studentDetails', function($q) use ($courseIds) {
            $q->whereIn('course_id', $courseIds);
        })
        ->with(['studentDetails.course.assignments', 'submissions'])
        ->get();

        $assignments = Assignment::with(['course', 'submissions'])->get();

        $submissions = AssignmentSubmission::with([
            'student',
            'assignment.course'
        ])->get();


        return view('teacher.reports.reports', compact('courses', 'students', 'assignments', 'submissions'));
    }

    public function studentReport()
    {
        $students = User::with([
            'studentDetails.course.assignments',
            'submissions'
        ])
        ->where('user_type', 'student')
        ->get();

        
        $courses = Course::where('teacher_id', Auth::id())->get();

        return view('teacher.reports.reports', compact('students', 'courses'));
    }
}
