<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.courseCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'videos.*' => 'mimes:mp4,mov,ogg,qt|max:51200',

        ]);

        $course = new Course();
        $course->title = $request->title;
        $course->description = $request->description;


        if ($request->hasFile('videos'))
        {
            $videoData = [];

            foreach ($request->file('videos') as $videoFile)
            {
                $video = $request->file('video');
                $videoName = time() . '_' . $videoFile->getClientOriginalName();

                $videoFile->move(public_path('videos'), $videoName);
                $videoData[] = $videoName;
            }
            $course->video = json_encode($videoData);
        }

        $course->save();

        return redirect('admin/courses')->with('success', 'Course with multiple videos uploaded!');
    }

    public function edit($id)
    {
        $course = Course::find($id);
        return view('admin.courses.editCourse', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'videos.*' => 'nullable|mimes:mp4,mov,avi|max:50000',
        ]);

        $course->title = $request->title;
        $course->description = $request->description;


        if ($request->hasFile('videos'))
        {
            $videoData = [];
            foreach ($request->file('videos') as $videoFile)
            {
                $videoName = time() . '_' . $videoFile->getClientOriginalName();
                $videoFile->move(public_path('uploads/videos'), $videoName);
                $videoData[] = $videoName;
            }
            $course->video = json_encode($videoData);
        }

        $course->save();

        return redirect('admin/courses')->with('success', 'Course updated successfully!');
    }

    public function deleteCourse($id)
    {
        $course = Course::with(['assignments.submissions', 'enrollments'])->findOrFail($id);

        // Delete course videos
        if ($course->video) {
            $videos = json_decode($course->video, true);

            if ($videos) {
                foreach ($videos as $v) {
                    $filePath = public_path('uploads/videos/' . $v);

                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }
            }
        }

        // Delete assignment submissions
        foreach ($course->assignments as $assignment) {
            foreach ($assignment->submissions as $submission) {

                $submissionFile = public_path('uploads/submissions/' . $submission->file);

                if (File::exists($submissionFile)) {
                    File::delete($submissionFile);
                }

                $submission->delete();
            }

            // Delete assignment file
            $assignmentFile = public_path('uploads/assignments/' . $assignment->file);

            if (File::exists($assignmentFile)) {
                File::delete($assignmentFile);
            }

            $assignment->delete();
        }

        // Delete enrollments
        $course->enrollments()->delete();

        // Delete course
        $course->delete();

        return redirect('admin/courses')->with('success', 'Course, assignments, submissions, and enrollments deleted successfully!');
    }


    public function updateStatus($id)
    {

        $course = Course::findOrFail($id);

        
        $course->status = ($course->status == 1) ? 0 : 1;
        $course->save();

        return redirect()->back()->with('success', 'Course status updated successfully!');
    }
}
