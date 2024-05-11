<?php

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
Route::group(["prefix"=> "vkr-journal"], function () {
    Route::get('/login', [UserController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    Route::get('/', function() {
        return redirect(route('redirect.homepage'));
    });

    Route::get('/redirect/homepage', [RedirectController::class, 'showCorrectHomepage'])->name('redirect.homepage');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/logout', [UserController::class, 'logout'])->name('logout');

        Route::get('/profile/{user:id}', [UserController::class, 'userProfile'])->name('profile')->middleware('can:view,user');

        Route::get('/profile/{user:id}/edit', [UserController::class, 'editProfile'])->name('editProfileForm')->middleware('can:update,user');

        Route::post('/profile/{user:id}/edit', [UserController::class, 'updateProfile'])->name('editProfile')->middleware('can:update,user');

        Route::middleware('can:create,App\Models\User')->group(function () {
            Route::get('/register', [AdminController::class, 'registerForm'])->name('registerForm');
            Route::post('/register', [AdminController::class, 'registerUsers'])->name('register');

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
                });
            });  
        });
        Route::middleware('can:create,App\Models\Plan')->group(function () {
            Route::get('/create-plan', [ProfessorController::class,'createPlanForm'])->name('createPlanForm');
            Route::post('/create-plan', [ProfessorController::class,'createPlan'])->name('createPlan');
        });

        Route::get('/edit-plan/{plan:id}', [ProfessorController::class, 'editPlanForm'])->name('editPlanForm')->middleware('can:update,plan');
        Route::post('/edit-plan/{plan:id}', [ProfessorController::class,'editPlan'])->name('editPlan')->middleware('can:update,plan');

        Route::get('/plan/{plan:id}', [ProfessorController::class,'viewPlan'])->name('viewPlan')->middleware('can:view,plan');

        Route::get('/{user:id}/plans', [ProfessorController::class,'viewPlans'])->name('viewPlans');

        Route::get('/plan/{plan:id}/edit-items', [ProfessorController::class,'editPlanItemsForm'])->name('editPlanItemsForm');
        Route::post('/plan/{plan:id}/edit-items', [ProfessorController::class,'editPlanItems'])->name('editPlanItems');

        Route::middleware([MustBeProfessor::class])->group(function () {
            Route::group(['prefix' => 'professor', 'namespace' => 'Professor'], function () {
                Route::get('/', function() {
                    return view('professor.index');
                })->name('professor.index');

                Route::get('/students', [ProfessorController::class,'viewStudents'])->name('professor.viewStudents');
            });
        });
    });
});