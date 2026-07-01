<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class AssignmentController extends Controller
{
    //  Assignment list
   public function index()
{
    // Jo tame teacher login hoy to fakt tamara j assignments dekhava joie
    $assignments = Assignment::where('teacher_id', Auth::id())->with('course')->get();

    return view('teacher.assignments.assignmentList', compact('assignments'));
}

    //  Create form
    public function create()
    {
        //$courses = Course::where('teacher_id', auth()->id())->get();
        $courses = Course::all();

        return view('teacher.assignments.assignmentCreate', compact('courses'));
    }

    //  Store assignment
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'course_id' => 'required',
        'deadline' => 'required|date',
        'file' => 'nullable|mimes:pdf,doc,docx|max:50000'
    ]);

    $assignment = new Assignment();
    $assignment->title = $request->title;
    $assignment->description = $request->description;
    $assignment->course_id = $request->course_id;
    
    // Fakt aa ek j line rakho, hardcoded '2' kadhi nakho
    $assignment->teacher_id = Auth::id(); 
    
    $assignment->deadline = $request->deadline;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('assignments'), $fileName);
        $assignment->file = $fileName;
    }

    $assignment->save();

    return redirect('teacher/assignments/assignmentList')->with('success', 'Assignment created successfully!');
}

    public function edit($id)
    {
        $assignment = Assignment::find($id);
        $courses = Course::where('teacher_id', auth()->id())->get();

        return view('teacher.assignments.assignmentEdit', compact('assignment','courses'));
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'course_id' => 'required',
            'deadline' => 'required|date',
            'file' => 'nullable|mimes:pdf,doc,docx|max:50000'
        ]);

        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->course_id = $request->course_id;
        $assignment->deadline = $request->deadline;

        // FILE UPDATE
        if ($request->hasFile('file')) {

            // old delete
            if ($assignment->file) {
                $oldPath = public_path('assignments/'.$assignment->file);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('file');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('assignments'), $fileName);

            $assignment->file = $fileName;
        }

        $assignment->save();

        return redirect('teacher/assignments/assignmentList')->with('success', 'Assignment updated successfully!');
    }

    public function delete($id)
    {
        $assignment = Assignment::find($id);

        if (!$assignment) {
            return back()->with('error', 'Assignment not found');
        }

        // file delete
        if ($assignment->file) {
            $path = public_path('assignments/'.$assignment->file);

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $assignment->delete();

        return back()->with('success', 'Assignment deleted successfully!');
    }
}
