<?php

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\UserAnswersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() =>  redirect()->route('home'));

Route::get("/home", function () {
    return view("home");
})->name('home');

Route::get("/registry", function () {
    return view("registry");
})->middleware("guest");

Route::post("/registry", [UserController::class, 'store'])->name("store");

Route::get("/log-in", function () {
    return view("login");
})->middleware("guest");

Route::post("/log-in", [UserController::class, 'login'])->name("login");

Route::get("/category/{name}", function ($name) {
    return view("category", ["category" => $name]);
})->name('category.show');

Route::get("/categories", function () {
    return view("categories");
});

Route::get("/about", function () {
    return view("about");
});

Route::get("/choose-category", function () {
    return view("choose-category");
})->middleware("auth");

Route::get("/exam", function () {
    return view("exam");
})->name("exam")->middleware("auth");

Route::get("/exam/{category}", [QuestionsController::class, "start_exam"])->name("questions.exam")->middleware("auth");

Route::post("/exam-submit", [QuestionsController::class, "submitAnswers"])->name("exam.submit")->middleware("auth");

Route::get('/exam-result/{examOrder}/{category}', [UserAnswersController::class, 'getExamResult'])->name('exam.result')->middleware('auth');

Route::get('/ranks', [UserAnswersController::class, 'getRansks'])->name('ranks');

Route::get('/user-profile', [UserController::class, 'user_profile'])->name('user_profile')->middleware('auth');

Route::put('/user', [UserController::class, 'update'])->name('user.update')->middleware('auth');
