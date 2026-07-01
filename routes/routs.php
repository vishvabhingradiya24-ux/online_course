<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('Main_Pages/home');
});

Route::get('/', [AuthController::class, 'homePage'])->name('home');

Route::get('/about', function () {
    return view('Main_Pages/about');
});

Route::get('contact', function () {
    return view('Main_Pages/contact');
});

Route::post('/contact_send', [AuthController::class, 'contact_send']);

Route::get('course', [AuthController::class, 'course']);

Route::get('course/{category}', [AuthController::class, 'courseByCategory']);

Route::get('course/details/{id}', [AuthController::class, 'courseDetails']);

// enroll with database

Route::post('course/enroll/{id}', [AuthController::class, 'enrollCourse'])->middleware('auth');

Route::get('layout', function () {
    return view('layout');
});

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/contact-send', [ContactController::class, 'send']);

//AuthController
Route::get('register', [AuthController::class, 'register']);
Route::post('register_process', [AuthController::class, 'register_Process']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::post('login_process', [AuthController::class, 'login_Process']);

Route::get('forget_password', [AuthController::class, 'forget_password']);
Route::post('forget_password_process', [AuthController::class, 'forget_password_process']);

Route::get('reset_password/{email}', [AuthController::class, 'reset_password_view']);

Route::post('update_password', [AuthController::class, 'update_password']);


//StudentController
Route::prefix('student')->group(function () {
    Route::get('dashboard', [StudentController::class,'dashboard']);
    Route::get('profile', [StudentController::class, 'student_profile']);
    Route::get('edit_profile', [StudentController::class, 'edit_student_profile']);
    Route::post('update-profile', [StudentController::class, 'update_student_profile']);
    Route::get('courses', [StudentController::class, 'myCourses'])->name('student.courses');
    Route::get('course/view/{id}', [StudentController::class, 'viewCourse'])->name('student.course.view')->middleware('auth');
    Route::get('course/{id}/start', [StudentController::class, 'startCourse']);
    Route::post('course/save-progress', [StudentController::class, 'saveProgress']);
    //assignmenrt
    Route::get('assignments', [StudentController::class, 'assignments']);
    Route::post('assignments/store', [StudentController::class, 'storeAssignment']);
    Route::get('assignments', [StudentController::class, 'assignments']);
});
Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->middleware('auth');
Route::get('student/join-course/{id}', [StudentController::class, 'joinCourse'])
    ->name('student.joinCourse')
    ->middleware('auth');

Route::get('student/my-courses', [StudentController::class, 'myCourses']);

Route::get('logout',[StudentController::class,'logout']);


//AdminController
Route::get('admin/dashboard', [AdminController::class,'dashboard']);
Route::get('admin/students', [AdminController::class,'students']);
Route::get('admin/teachers', [AdminController::class,'teachers']);
Route::get('admin/courses', [AdminController::class,'courses']);
Route::get('admin/category', [AdminController::class,'category']);
Route::get('admin/profile', [AdminController::class,'profile']);
Route::post('admin/update_profile', [AdminController::class, 'update_profile']);

// Admin group ni andar aa route add karo
Route::get('admin/verify_users', [AdminController::class, 'pendingUsers']);
// ->name('admin.verify');

Route::post('/admin/user/approve/{id}', [AdminController::class, 'approveUser'])->name('admin.user.approve');
Route::post('/admin/user/reject/{id}', [AdminController::class, 'rejectUser'])->name('admin.user.reject');



//CourseController

Route::get('admin/courses', [CourseController::class, 'index']);
Route::get('admin/courses/create', [CourseController::class, 'create']);
Route::post('admin/courses', [CourseController::class, 'store']);
Route::get('admin/courses/edit/{id}', [CourseController::class, 'edit']);
Route::put('admin/courses/update/{id}', [CourseController::class, 'update']);
Route::delete('admin/courses/delete/{id}', [CourseController::class, 'deleteCourse']);



//CategoryController


Route::get('admin/category', [CategoryController::class, 'index']);
Route::get('admin/category/create', [CategoryController::class, 'create']);
Route::post('admin/category/store', [CategoryController::class, 'store']);
Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit']);
Route::put('admin/category/update/{id}', [CategoryController::class, 'update']);
Route::delete('admin/category/delete/{id}', [CategoryController::class, 'deleteCategory']);



Route::get('admin/student/studentDetails/{id}', [AdminController::class, 'viewStudent']);
Route::get('admin/teacher/teacherDetails/{id}', [AdminController::class, 'viewTeacher']);




//TeacherController
Route::get('teacher/dashboard', [TeacherController::class,'dashboard']);
Route::get('teacher/profile', [TeacherController::class,'teacher_profile']);
Route::get('teacher/edit_profile',[TeacherController::class, 'edit_teacher_profile']);
Route::post('teacher/update_profile', [TeacherController::class, 'update_teacher_profile']);

Route::get('teacher/courses/coursesList', [TeacherController::class, 'courses']);
Route::get('teacher/courses/courseCreate', [TeacherController::class, 'create']);
Route::post('teacher/courses/store', [TeacherController::class, 'store']);
Route::get('teacher/courses/edit/{id}', [TeacherController::class, 'edit']);
Route::put('teacher/courses/update/{id}', [TeacherController::class, 'update']);
Route::delete('teacher/courses/delete/{id}', [TeacherController::class, 'deleteCourse']);



Route::get('teacher/assignments/assignmentList', [AssignmentController::class, 'index']);
// ->name('teacherPanal.assignments.assignmentList');

Route::get('teacher/assignments/assignmentCreate', [AssignmentController::class, 'create']);
// ->name('teacherPanal.assignments.assignmentCreate');

Route::post('teacher/assignments/store', [AssignmentController::class, 'store']);
// ->name('teacherPanal.assignments.store');

Route::get('teacher/assignments/edit/{id}', [AssignmentController::class, 'edit']);
// ->name('teacherPanal.assignments.assignmentEdit');

Route::put('teacher/assignments/update/{id}', [AssignmentController::class, 'update']);
// ->name('teacherPanal.assignments.update');

Route::delete('teacher/assignments/delete/{id}', [AssignmentController::class, 'delete']);
// ->name('teacherPanal.assignments.deleteassignment');



Route::get('teacher/reports/reports', [ReportController::class, 'reports']);
// ->name('teacherPanal.reports.reports');


Route::get('teacher/reports/courseReport', [ReportController::class, 'courseReport']);
// ->name('teacherPanal.reports.courseReport');

Route::get('teacher/reports/studentReport', [ReportController::class, 'studentReport']);
// ->name('teacherPanal.reports.studentReport');

Route::get('teacher/courses/video/{video_name}', [TeacherController::class, 'showVideo']);
// ->name('video.show');


Route::patch('admin/courses/status/{id}', [CourseController::class, 'updateStatus']);

// Teacher માટે
Route::patch('teacher/courses/status/{id}', [CourseController::class, 'updateStatus']);
