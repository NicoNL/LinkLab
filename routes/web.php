<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Teacher\SubjectController as TeacherSubjectController;
use App\Http\Controllers\Teacher\TaskController as TeacherTaskController;
use App\Http\Controllers\Teacher\SolutionController as TeacherSolutionController;
use App\Http\Controllers\Student\SubjectController as StudentSubjectController;
use App\Http\Controllers\Student\TaskController as StudentTaskController;

Route::get('/', function () {
    return view('welcome');
});

//home
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

//teacher
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('subjects', TeacherSubjectController::class);
    
    Route::get('subjects', [TeacherSubjectController::class, 'index'])->name('subjects.index');
    Route::get('subjects/{subject}/tasks/create', [TeacherTaskController::class, 'createTask'])->name('tasks.create');
    Route::post('subjects/{subject}/tasks', [TeacherTaskController::class, 'storeTask'])->name('tasks.store');
    Route::get('subjects/{subject}/tasks/{task}', [TeacherTaskController::class, 'showTask'])->name('tasks.show');
    Route::get('subjects/{subject}/tasks/{task}/edit', [TeacherTaskController::class, 'editTask'])->name('tasks.edit');
    Route::put('subjects/{subject}/tasks/{task}', [TeacherTaskController::class, 'updateTask'])->name('tasks.update');
    Route::delete('subjects/{subject}/tasks/{task}', [TeacherTaskController::class, 'destroyTask'])->name('tasks.destroy');
    
    Route::get('subjects/{subject}/tasks/{task}/solutions/{solution}/evaluate', [TeacherSolutionController::class, 'evaluateSubject'])->name('solutions.evaluate');
    Route::put('subjects/{subject}/tasks/{task}/solutions/{solution}', [TeacherSolutionController::class, 'updateSubject'])->name('solutions.update');
    Route::get('solutions/{solution}/download', [TeacherSolutionController::class, 'download'])->name('solutions.download');
    Route::post('subjects/{subject}/tasks/{task}/grade-all', [TeacherSolutionController::class, 'gradeAll'])->name('solutions.gradeAll');
});

//student
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {

    Route::get('subjects/available', [StudentSubjectController::class, 'available'])->name('subjects.available');
    Route::get('subjects', [StudentSubjectController::class, 'index'])->name('subjects.index');
    
    Route::post('subjects/{subject}/take', [StudentSubjectController::class, 'take'])->name('subjects.take');
    Route::delete('subjects/{subject}/leave', [StudentSubjectController::class, 'leave'])->name('subjects.leave');
    Route::get('subjects/{subject}', [StudentSubjectController::class, 'show'])->name('subjects.show');
    
    Route::get('subjects/{subject}/tasks/{task}', [StudentTaskController::class, 'show'])->name('tasks.show');
    Route::post('subjects/{subject}/tasks/{task}/submit', [StudentTaskController::class, 'submitTask'])->name('tasks.submit');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


