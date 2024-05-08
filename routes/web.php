<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}/delete', [ProductController::class, 'delete'])->name('product.delete');
});


Route::middleware('auth')->group(function () {
    Route::get("/blog", [BlogController::class, "index"])->name("blog.index");
    Route::get("/blog/create", [BlogController::class, "create"])->name("blog.create");
    Route::post("/blog", [BlogController::class, "store"])->name("blog.store");
    Route::get("/blog/{blog}/edit", [BlogController::class, "edit"])->name("blog.edit");
    Route::put("/blog/{blog}/update", [BlogController::class, "update"])->name("blog.update");
    Route::delete("/blog/{blog}/delete", [BlogController::class, "delete"])->name("blog.delete");
    Route::get("/blog/{blog}", [BlogController::class, "single"])->name("blog.single");
 });
 
 
 Route::middleware('auth')->group(function () {
     Route::post("/blog/{blog}/comments", [CommentController::class, "store"])->name("comments.store");
     Route::get("/blog/{blog}/comments", [CommentController::class, "display"])->name("comments.display");
     Route::delete("/blog/{blog}/comments/{comment}", [CommentController::class, "delete"])->name("comments.delete");
 });


 Route::middleware('auth')->group(function () {
    Route::post('/comment/{comment}/like', [LikeController::class, 'like'])->name('comment.like');
    Route::delete('/comment/{comment}/unlike', [LikeController::class, 'unlike'])->name('comment.unlike');

});
require __DIR__.'/auth.php';


