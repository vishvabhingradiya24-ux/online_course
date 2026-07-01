<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Studentdetails;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Course;
use App\Models\Enrollment;

class StudentController extends Controller
{
    public function overview(){
        return view('student.overview');
    }
public function dashboard()
{
    $studentId = auth()->id();

    // Only last 2 enrolled courses
    $courses = Enrollment::with('course')
        ->where('student_id', $studentId)
        ->latest()
        ->take(2)
        ->get();

    // Total enrolled courses
    $totalCourses = Enrollment::where('student_id', $studentId)->count();

    $totalVideos = 0;
    $watchedVideos = 0;

    foreach ($courses as $enroll) {
        $videos = json_decode($enroll->course->video, true);

        if (is_array($videos)) {
            $totalVideos += count($videos);

            if ($enroll->last_watched_video) {
                $watchedVideos++;
            }
        }
    }

    $progress = $totalVideos > 0 ? round(($watchedVideos / $totalVideos) * 100) : 0;

    return view('student.dashboard', compact(
        'courses',
        'totalCourses',
        'progress'
    ));
}

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function student_profile()
    {
        return view('student.profile');
    }

    public function edit_student_profile()
    {
        return view('student.edit_profile');
    }

    public function update_student_profile(Request $request)
{
    // Auth::user() માંથી ID લઈને ડેટાબેઝમાંથી ફ્રેશ રેકોર્ડ લાવો
    $user = User::find(Auth::user()->id);

    $request->validate([
        'name' => 'required|string|max:255',
        'mobileno' => 'nullable|numeric',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user->name = $request->name;
    $user->mobileno = $request->mobileno;


    if ($request->remove_photo == "1") {
        if ($user->profile_photo) {
            $oldPath = public_path('uploads/profile/' . $user->profile_photo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            $user->profile_photo = null;
        }
    }
    elseif ($request->hasFile('profile_photo')) {
        // જો નવો ફોટો હોય તો જૂનો ડિલીટ કરો
        if ($user->profile_photo) {
            $oldPath = public_path('uploads/profile/' . $user->profile_photo);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $file = $request->file('profile_photo');
        $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile'), $filename);
        $user->profile_photo = $filename;
    }

    $user->save(); // આ લાઇન ડેટાબેઝમાં ફેરફાર સેવ કરશે

    return redirect('student/profile')->with('success', 'Profile updated successfully!');
}


public function myCourses()
{
    $studentId = Auth::id();

    $enrolledCourses = Enrollment::where('student_id', $studentId)
                        ->with('course')
                        ->get();


    return view('student.my_courses', compact('enrolledCourses'));
}

public function viewCourse($id)
{
    $course = Course::findOrFail($id);

    return view('student.view-course', compact('course'));
}
public function startCourse($id)
{
    $studentId = auth()->id();

    $enrollment = Enrollment::where('student_id', $studentId)
        ->where('course_id', $id)
        ->firstOrFail();

    $course = $enrollment->course;
    $videos = json_decode($course->video, true);

    // Resume from last watched video
    if ($enrollment->last_watched_video) {
        $video = $enrollment->last_watched_video;
    } else {
        $video = $videos[0] ?? null;
    }

    if (!$video) {
        return back()->with('error', 'No video found.');
    }

    return view('student.course_video', compact('course', 'video'));
}
public function saveProgress(Request $request)
{
    $studentId = auth()->id();

    Enrollment::where('student_id', $studentId)
        ->where('course_id', $request->course_id)
        ->update([
            'last_watched_video' => $request->video
        ]);

    return response()->json(['success' => true]);
}
public function assignments(Request $request)
{
    $status = $request->status;

    $courseIds = Enrollment::where('student_id', auth()->id())
        ->pluck('course_id');

    $assignments = Assignment::with([
        'course',
        'submissions' => function ($q) {
            $q->where('student_id', auth()->id());
        }
    ])
    ->whereIn('course_id', $courseIds)
    ->latest()
    ->get();

    if ($status == 'pending') {
        $assignments = $assignments->filter(function ($assignment) {
            return $assignment->submissions->isEmpty();
        });
    }

    if ($status == 'complete') {
        $assignments = $assignments->filter(function ($assignment) {
            return $assignment->submissions->isNotEmpty();
        });
    }

    return view('student.assignments', compact('assignments', 'status'));
}
public function uploadAssignment(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:pdf'
    ]);

    $fileName = time().'.'.$request->file('file')->extension();

    $request->file('file')->move(public_path('uploads/submissions'), $fileName);

    AssignmentSubmission::create([
        'assignment_id' => $request->assignment_id,
        'student_id' => auth()->id(),
        'file' => $fileName
    ]);

    return redirect('student/assignments')->with('success', 'Assignment submitted successfully');
}
public function showAssignment($id)
{
    $assignment = Assignment::with('course')->findOrFail($id);

    return view('student.submit', compact('assignment'));
}
public function downloadSubmission($filename)
{
    $path = public_path('uploads/submissions/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path);
}
public function viewSubmission($filename)
{
    $path = public_path('uploads/submissions/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
}

public function storeAssignment(Request $request)
{
    $request->validate([
        'assignment_id' => 'required',
        'file' => 'required|mimes:pdf,doc,docx,zip'
    ]);

    $file = $request->file('file');
    $fileName = time().'_'.$file->getClientOriginalName();
    $file->move(public_path('uploads/submissions'), $fileName);

    AssignmentSubmission::create([
        'assignment_id' => $request->assignment_id,
        'student_id' => auth()->id(),
        'file' => $fileName,
        'status' => 'submitted',
        'submitted_at' => now()
    ]);

    return redirect('student/assignments')
        ->with('success', 'Assignment submitted successfully!');
}
public function createAssignment()
{
    $courses = Studentdetails::with('course')
                ->where('student_id', auth()->id())
                ->get();

    return view('student.assignments.create', compact('courses'));
}



}
