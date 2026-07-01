<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Course;
use App\Models\Category;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\File;


class TeacherController extends Controller
{
    public function dashboard()
    {
        $totalStudents = User::where('user_type', 'student')->count();
        $liveCourses = Course::where('status', 'active')->count();
        $submissionsCount = AssignmentSubmission::count();
        $recentStudents = User::where('user_type', 'student')->orderBy('created_at', 'desc')->take(5)->get();

        return view('teacher.overview', compact('totalStudents','liveCourses','submissionsCount','recentStudents'));
    }

    public function teacher_profile()
    {
        return view('teacher.profile');
    }

    public function edit_teacher_profile()
    {
        return view('teacher.edit_profile');
    }

    public function update_teacher_profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->mobileno = $request->mobileno;

        if ($request->hasFile('profile_photo'))
        {

            if (!empty($user->profile_photo) && file_exists(public_path('uploads/profile/'.$user->profile_photo)))
            {
                unlink(public_path('uploads/profile/'.$user->profile_photo));
            }

            $file = $request->file('profile_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move(public_path('uploads/profile/'), $filename);

            $user->profile_photo = $filename;
        }

        if ($request->remove_photo == "1")
        {
            if (!empty($user->profile_photo) && file_exists(public_path('uploads/profile/'.$user->profile_photo)))
            {
                unlink(public_path('uploads/profile/'.$user->profile_photo));
            }
            $user->profile_photo = null;
        }
        $user->save();
        return redirect('teacher/profile')->with('success', 'Profile updated successfully');
    }

    public function courses()
    {
        $courses = Course::where('teacher_id', Auth::id())->get();
        return view('teacher.courses.coursesList', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('teacher.courses.courseCreate',compact('categories'));
    }

   public function store(Request $request)
{
   
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'category_id' => 'required',
        'videos.*' => 'mimes:mp4,mov,avi|max:50000'
    ]);


    if (!Auth::check()) {
        return redirect('login')->with('error', 'Please login to add a course.');
    }

    $course = new Course();
    $course->title = $request->title;
    $course->description = $request->description;
    $course->category_id = $request->category_id;
    $course->teacher_id = Auth::id();


    if ($request->hasFile('videos'))
    {
        $videoData = [];
        foreach ($request->file('videos') as $videoFile)
        {
            $videoName = time().'_'.$videoFile->getClientOriginalName();

            $videoFile->move(public_path('videos'), $videoName);
            $videoData[] = $videoName;
        }
        $course->video = json_encode($videoData);
    }

    $course->save();

    return redirect('teacher/courses/coursesList')->with('success', 'Course added successfully!');
}
    public function edit($id)
    {
        $course = Course::where('id', $id)
                ->where('teacher_id', Auth::id())
                ->firstOrFail();
        return view('teacher.courses.editCourseDetails', compact('course'));
    }

    // public function update(Request $request, $id)
    // {
    //     $course = Course::find($id);

    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'videos.*' => 'nullable|mimes:mp4,mov,avi|max:50000',]);

    //     $course->title = $request->title;
    //     $course->description = $request->description;

    //     if ($request->hasFile('videos'))
    //     {
    //         $videoData = [];
    //         foreach ($request->file('videos') as $videoFile)
    //         {
    //             $videoName = time() . '_' . $videoFile->getClientOriginalName();
    //             $videoFile->move(public_path('uploads/videos'), $videoName);
    //             $videoData[] = $videoName;
    //         }
    //         $course->video = json_encode($videoData);
    //     }

    //     $course->save();

    //     return redirect('teacher/courses/coursesList')->with('success', 'Course updated successfully!');
    // }

    public function update(Request $request, $id)
    {
        $course = Course::where('id', $id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'videos.*' => 'nullable|mimes:mp4,mov,avi|max:50000',
        ]);

        $course->title = $request->title;
        $course->description = $request->description;


        $existingVideos = json_decode($course->video, true) ?: [];


        if ($request->hasFile('videos')) {
            $newVideoData = [];
            foreach ($request->file('videos') as $videoFile) {
                $videoName = time() . '_' . $videoFile->getClientOriginalName();


                $videoFile->move(public_path('videos'), $videoName);
                $newVideoData[] = $videoName;
            }


            $allVideos = array_merge($existingVideos, $newVideoData);


            $course->video = json_encode($allVideos);
        }

        $course->save();

        return redirect('teacher/courses/coursesList')->with('success', 'Course updated with new videos!');
    }

    public function deleteCourse($id)
    {
        $course = Course::where('id', $id)
            ->where('teacher_id', Auth::id())
            ->first();

        if (!$course)
        {
            return redirect()->back()->with('error', 'Course not found!');
        }

        if ($course->video)
        {
            $videos = is_array($course->video) ? $course->video : json_decode($course->video, true);

            if ($videos)
            {
                foreach ($videos as $v)
                {
                    $filePath = public_path('uploads/videos/' . $v);
                    if (File::exists($filePath))
                    {
                        File::delete($filePath);
                    }
                }
            }
        }

        $course->delete();

        return redirect('teacher/courses/coursesList')->with('success', 'Course and videos deleted successfully!');
    }

    public function showVideo($video_name)
{

    return view('teacher.courses.viewVideo', compact('video_name'));
}

}
