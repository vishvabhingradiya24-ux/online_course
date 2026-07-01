<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\AssignmentSubmission;

class ReportController extends Controller
{
    public function reports()
    {
        return view('teacher.reports.reports');
    }
    public function courseReport()
    {
        $courses = Course::with([
            'assignments.submissions',
            'studentDetails'
        ])->where('teacher_id', auth()->id())->get();

        return view('teacher.reports.reports', compact('courses'));
    }
    public function studentReport()
    {
        $students = User::with([
            'studentDetails.course.assignments',
            'submissions'
        ])
        ->where('user_type', 'student')
        ->get();

        return view('teacher.reports.reports', compact('students'));
    }
}
