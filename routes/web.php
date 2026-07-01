<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'homePage'])->name('home');

Route::view('/about', 'Main_Pages.about');
Route::view('/contact', 'Main_Pages.contact');

Route::post('/contact_send', [AuthController::class, 'contact_send']);

Route::get('/course', [AuthController::class, 'course']);
Route::get('/course/{category}', [AuthController::class, 'courseByCategory']);
Route::get('/course/details/{id}', [AuthController::class, 'courseDetails']);

Route::post('/course/enroll/{id}', [AuthController::class, 'enrollCourse'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register_process', [AuthController::class, 'register_Process']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/forget_password', [AuthController::class, 'forget_password']);
    Route::post('/forget_password_process', [AuthController::class, 'forget_password_process']);

    Route::get('/reset_password/{email}', [AuthController::class, 'reset_password_view']);
    Route::post('/update_password', [AuthController::class, 'update_password']);
});

Route::get('/logout', [StudentController::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::prefix('student')->middleware(['auth', 'role:student'])->group(function () {

    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

    Route::get('/profile', [StudentController::class, 'student_profile']);
    Route::get('/edit_profile', [StudentController::class, 'edit_student_profile']);
    Route::post('/update-profile', [StudentController::class, 'update_student_profile']);

    Route::get('/courses', [StudentController::class, 'myCourses'])->name('student.courses');
    Route::get('/course/view/{id}', [StudentController::class, 'viewCourse'])->name('student.course.view');
    Route::get('/course/{id}/start', [StudentController::class, 'startCourse']);
    Route::post('/course/save-progress', [StudentController::class, 'saveProgress']);

    Route::get('/assignments', [StudentController::class, 'assignments']);
    Route::post('/assignments/store', [StudentController::class, 'storeAssignment']);
    Route::get('enroll/course/{id}', [AuthController::class, 'enrollCourse'])->middleware('auth');


    Route::get('assignment/submit/{id}', [StudentController::class, 'showAssignment']);
    Route::post('assignment/upload', [StudentController::class, 'uploadAssignment']);

    Route::get('assignment/submit/{id}', [StudentController::class, 'showAssignment']);
    Route::post('assignment/upload', [StudentController::class, 'uploadAssignment']);
    Route::get('download-submission/{filename}', [StudentController::class, 'downloadSubmission']);
    Route::get('view-submission/{filename}', [StudentController::class, 'viewSubmission']);
    });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/students', [AdminController::class, 'students']);
    Route::get('/teachers', [AdminController::class, 'teachers']);
    Route::get('/profile', [AdminController::class, 'profile']);
    Route::post('/update_profile', [AdminController::class, 'update_profile']);

    Route::get('/verify_users', [AdminController::class, 'pendingUsers']);
    Route::post('/user/approve/{id}', [AdminController::class, 'approveUser'])->name('admin.user.approve');
    Route::post('/user/reject/{id}', [AdminController::class, 'rejectUser'])->name('admin.user.reject');

    Route::get('/student/studentDetails/{id}', [AdminController::class, 'viewStudent']);
    Route::get('/teacher/teacherDetails/{id}', [AdminController::class, 'viewTeacher']);

    // Course
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/create', [CourseController::class, 'create']);
    Route::post('/courses', [CourseController::class, 'store']);
    Route::get('/courses/edit/{id}', [CourseController::class, 'edit']);
    Route::put('/courses/update/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/delete/{id}', [CourseController::class, 'deleteCourse']);
    Route::patch('/courses/status/{id}', [CourseController::class, 'updateStatus']);

    // Category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category/store', [CategoryController::class, 'store']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
    Route::put('/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'deleteCategory']);
});

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/

Route::prefix('teacher')->middleware(['auth', 'role:teacher'])->group(function () {

    Route::get('/dashboard', [TeacherController::class, 'dashboard']);
    Route::get('/profile', [TeacherController::class, 'teacher_profile']);
    Route::get('/edit_profile', [TeacherController::class, 'edit_teacher_profile']);
    Route::post('/update_profile', [TeacherController::class, 'update_teacher_profile']);

    // Courses
    Route::get('/courses/coursesList', [TeacherController::class, 'courses']);
    Route::get('/courses/courseCreate', [TeacherController::class, 'create']);
    Route::post('/courses/store', [TeacherController::class, 'store']);
    Route::get('/courses/edit/{id}', [TeacherController::class, 'edit']);
    Route::put('/courses/update/{id}', [TeacherController::class, 'update']);
    Route::delete('/courses/delete/{id}', [TeacherController::class, 'deleteCourse']);
    Route::patch('/courses/status/{id}', [CourseController::class, 'updateStatus']);

    Route::get('/courses/video/{video_name}', [TeacherController::class, 'showVideo']);

    // Assignments
    Route::get('/assignments/assignmentList', [AssignmentController::class, 'index']);
    Route::get('/assignments/assignmentCreate', [AssignmentController::class, 'create']);
    Route::post('/assignments/store', [AssignmentController::class, 'store']);
    Route::get('/assignments/edit/{id}', [AssignmentController::class, 'edit']);
    Route::put('/assignments/update/{id}', [AssignmentController::class, 'update']);
    Route::delete('/assignments/delete/{id}', [AssignmentController::class, 'delete']);

    // Reports
    Route::get('/reports/reports', [ReportController::class, 'reports']);
    Route::get('/reports/courseReport', [ReportController::class, 'courseReport']);
    Route::get('/reports/studentReport', [ReportController::class, 'studentReport']);
});
