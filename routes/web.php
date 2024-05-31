<?php

use App\Http\Controllers\StudentController;
use App\Http\Middleware\MustBeAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MustBeStudent;
use App\Http\Controllers\UserController;
use App\Http\Middleware\MustBeProfessor;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ProfessorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::group(["prefix"=> "vkr-journal"], function () {
    Route::get('/login', [UserController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    Route::get('/', function() {
        return redirect(route('redirect.homepage'));
    })->name('index');

    Route::get('/redirect/homepage', [RedirectController::class, 'showCorrectHomepage'])->name('redirect.homepage');

    Route::group(['middleware' => ['auth']], function () {
        Route::fallback(function(){
            return view('errors.404');
        });

        Route::get('/logout', [UserController::class, 'logout'])->name('logout');

        Route::get('/profile/{user:id}', [UserController::class, 'userProfile'])->name('profile')->middleware('can:view,user');

        Route::get('/profile/{user:id}/edit', [UserController::class, 'editProfile'])->name('editProfileForm')->middleware('can:update,user');

        Route::post('/profile/{user:id}/edit', [UserController::class, 'updateProfile'])->name('editProfile')->middleware('can:update,user');

        Route::middleware('can:create,App\Models\User')->group(function () {
            Route::get('/register', [AdminController::class, 'registerForm'])->name('registerForm');
            Route::post('/register', [AdminController::class, 'registerUsers'])->name('register');

        });
        Route::middleware('can:viewAny,App\Models\User')->group(function () {
            Route::get('/user-list', [AdminController::class, 'getUsers'])->name('userList');
        });

        Route::middleware([MustBeAdmin::class])->group(function () {
            Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
                Route::get('/', function() {
                    return view('admin.index');
                })->name('admin.index');
            });  
        });

        Route::middleware([MustBeStudent::class])->group(function () {
            Route::group(['prefix' => 'student', 'namespace' => 'Student'], function () {
                Route::get('/', function() {
                    return view('student.index');
                })->name('student.index');
            });  
        });
        Route::middleware('can:create,App\Models\Plan')->group(function () {
            Route::get('/plan/create', [ProfessorController::class,'createPlanForm'])->name('createPlanForm');
            Route::post('/plan/create', [ProfessorController::class,'createPlan'])->name('createPlan');
        });

        Route::get('/plan/{plan:id}/edit', [ProfessorController::class, 'editPlanForm'])->name('editPlanForm')->middleware('can:update,plan');
        Route::post('/plan/{plan:id}/edit', [ProfessorController::class,'editPlan'])->name('editPlan')->middleware('can:update,plan');

        Route::get('/plan/{plan:id}', [ProfessorController::class,'viewPlan'])->name('viewPlan')->middleware('can:view,plan');
        Route::get('plan/{plan:id}/copy-to-myself', [ProfessorController::class,'copyPlan'])->name('copyPlan')->middleware([MustBeProfessor::class]);

        Route::get('/profile/{user:id}/plans', [ProfessorController::class,'viewPlans'])->name('viewPlans');

        Route::get('/profile/{user:id}/plan-progress/{plan_progress}', [StudentController::class,'viewPlanProgressItem'])->name('viewPlanProgressItem');

        Route::get('/profile/{user:id}/plan-progress', [StudentController::class,'viewPlanProgress'])->name('viewPlanProgress');

        Route::get('/plan/{plan:id}/edit-items', [ProfessorController::class,'editPlanItemsForm'])->name('editPlanItemsForm')->middleware('can:update,plan');
        Route::post('/plan/{plan:id}/edit-items', [ProfessorController::class,'editPlanItems'])->name('editPlanItems')->middleware('can:update,plan');

        
        Route::get('/profile/{user:id}/students', [ProfessorController::class,'viewStudents'])->name('viewStudents');
        Route::post('profile/{user:id}/students/appoint-plan/{plan:id}', [ProfessorController::class,'appointPlan'])->name('appointPlan')->middleware('can:update,plan');

        Route::middleware([MustBeProfessor::class])->group(function () {
            Route::group(['prefix' => 'professor', 'namespace' => 'Professor'], function () {
                Route::get('/', function() {
                    return view('professor.index');
                })->name('professor.index');

            });
        });

        Route::get('/profile/{user:id}/theses', [StudentController::class,'viewTheses'])->name('viewTheses');
        Route::get('/thesis/{thesis:id}', [StudentController::class,'viewThesis'])->name('viewThesis');
        Route::get('/delete-thesis/{thesis:id}', [StudentController::class,'deleteThesis'])->name('deleteThesis');

        Route::get('/thesis/{thesis:id}/chapter/{order}', [StudentController::class,'viewChapter'])->name('viewChapter');
    });
//});