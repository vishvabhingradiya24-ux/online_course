<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Auth;

class AdminController extends Controller
{
    public function dashboard() 
    {
        $total_students = User::where('user_type', 'student')->count();
        $total_teachers = User::where('user_type', 'teacher')->count();
        $total_courses  = Course::count();
        $total_revenue  = 92450; 

        $recent_students = User::where('user_type', 'student')
                            ->orderBy('id', 'desc')
                            ->take(5)
                            ->get();

        $recent_teachers = User::where('user_type', 'teacher')
                            ->orderBy('id', 'desc')
                            ->take(5)
                            ->get();

        return view('admin.overview', compact(
            'total_students', 
            'total_teachers', 
            'total_courses', 
            'total_revenue',
            'recent_students',
            'recent_teachers' 
        ));
    }

    public function students() 
    {
        $students = User::where('user_type', 'student')->get();

        return view('admin.studentsmanage',compact('students'));
    }

    public function teachers()
    {
       $teachers = User::where('user_type', 'teacher')->get();

        return view('admin.teachersmanage', compact('teachers'));
    }
 
    public function courses()
    {
        $courses = Course::all(); 
        return view('admin.courses', compact('courses'));
    } 

    public function category()
    {
        return view('admin.category');
    }

    public function viewStudent($id)
    {
        $student = User::with([
            'studentdetails.course.teacher'
        ])->find($id);

        return view('admin.student.studentDetails', compact('student'));
    }

    public function viewTeacher($id)
    {
        $teacher = User::with([
            'courses.studentDetails.student'
        ])->find($id);

        return view('admin.teacher.teacherDetails', compact('teacher'));
    }

    public function profile()
    {
        return view('admin.profile'); 
    }

    public function update_profile(Request $request)
    {
        $admin = User::find(Auth::user()->id);
        
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->hasFile('profile_photo')) 
        {
            if ($admin->profile_photo && file_exists(public_path('uploads/profile/'.$admin->profile_photo))) 
            {
                unlink(public_path('uploads/profile/'.$admin->profile_photo));
            }

            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile/'), $filename);
            
            $admin->profile_photo = $filename;
        }

        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }    
}
