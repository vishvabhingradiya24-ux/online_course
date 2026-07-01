<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;
use App\Models\Category;
use App\Models\Enrollment;

class AuthController extends Controller
{
        // ફાઈલની સૌથી ઉપર આ હોવું જોઈએ


// ક્લાસની અંદર આ ફંક્શન ઉમેરો
public function homePage() {
    $courses = Course::with('category')->latest()->get();
    return view('Main_Pages/home', compact('courses'));
}
    public function showLogin()
    {
        return view('login');
    }

    public function loginForm()
    {
        return view('login'); // ✅ correct
    }
        public function register()
    {
        return view('register');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contact_send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        return redirect()->back()->with('success', 'તમારો મેસેજ અમને મળી ગયો છે!');
    }

    public function course()
    {
        $courses = Course::with('category')->get();
        $categories = Category::all();

        return view('Main_Pages/course', compact('courses', 'categories'));
    }

    public function courseByCategory($categoryId)
    {
        $courses = Course::where('category_id', $categoryId)->get();
        $categories = Category::all();

        return view('Main_Pages.course', compact('courses', 'categories'));
    }

    public function courseDetails($id)
    {
        $course = Course::with('category')->findOrFail($id);

        $isEnrolled = false;

        if (Auth::check()) {
            $isEnrolled = Enrollment::where('student_id', Auth::id())
                ->where('course_id', $id)
                ->exists();
        }

        return view('Main_Pages.course_details', compact('course', 'isEnrolled'));
    }

    public function register_process(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'mobileno' => 'required|digits:10',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6'
        ]);

        $user_type = $req->user_type ?? 'student';

        User::create([
            'name' => $req->name,
            'mobileno' => $req->mobileno,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'user_type' => $user_type
        ]);

        return redirect('login')->with('msg', 'Registration successful!');
    }

    // public function login()
    // {
    //     return view('login');
    // }


    public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $req->email,
            'password' => $req->password
        ])) {

            $user = Auth::user();

            if ($user->user_type == 'admin') {
                return redirect('/admin/dashboard');
            }

            if ($user->user_type == 'teacher') {
                return redirect('/teacher/dashboard');
            }

            return redirect('/');
        }

        return redirect('/login')
            ->with('error', 'Invalid Email or Password!')
            ->withInput();
    }

    public function forget_password()
    {
        return view('forget_password');
    }

    public function reset_password_view($email)
    {
        return view('reset_password', compact('email'));
    }

    public function forget_password_process(Request $req)
    {
        $email = $req->email;
        $user = User::where('email', $email)->first();

        if ($user)
        {
            return redirect('reset_password/' . $email);
        }
        else
        {
            return back()->with('error', 'Email not found!');
        }
    }

    public function update_password(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ],
        ['password.confirmed' => 'The password confirmation does not match.']);

        $user = User::where('email', $req->email)->first();

        if ($user)
        {
            $user->password = Hash::make($req->password);
            $user->save();

            return redirect('login')->with('msg', 'Password updated successfully! Please login.');
        }
        else
        {
            return redirect('forget_password')->with('error', 'User not found!');
        }
    }

    public function enrollCourse($id)
    {
        $studentId = Auth::id();

        $alreadyEnrolled = Enrollment::where('student_id', $studentId)
            ->where('course_id', $id)
            ->exists();

        if (!$alreadyEnrolled) {
            Enrollment::create([
                'student_id' => $studentId,
                'course_id' => $id,
            ]);
        }

        return redirect()->back()->with('success', 'Successfully enrolled in this course!');
    }
}
