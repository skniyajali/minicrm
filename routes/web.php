<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

//CompanyRoutes
Route::get('/companies',[CompaniesController::class,'index'])->name('companies');
Route::post('/companies_create',[CompaniesController::class,'store'])->name('companies_create');
Route::post('/companies_edit',[CompaniesController::class,'edit'])->name('companies_edit');
Route::post('/companies_delete',[CompaniesController::class,'delete'])->name('companies_delete');

//EmployeRoute
Route::get('/employees',[EmployeesController::class,'index'])->name('employees');
Route::post('/employees_create',[EmployeesController::class,'store'])->name('employees_create');
Route::post('/employees_edit',[EmployeesController::class,'edit'])->name('employees_edit');
Route::post('/employees_delete',[EmployeesController::class,'delete'])->name('employees_delete');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
