<?php
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BreakingNewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\IklanController;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('layouts.home');
// });
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully.';
});
Route::get('/storage/{filename}', function ($filename) {
    $path = storage_path('app/public/post/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return response($file, 200)->header("Content-Type", $type);
});



Route::prefix('iklan')->name('iklan.')->middleware('auth')->group(function () {
    Route::get('/', [IklanController::class, 'index'])->name('index');
    Route::get('/tambah', [IklanController::class, 'create'])->name('create');
    Route::post('/simpan', [IklanController::class, 'store'])->name('store');
    Route::get('/{iklan}', [IklanController::class, 'show'])->name('show');
    Route::get('/{iklan}/edit', [IklanController::class, 'edit'])->name('edit');
    Route::put('/{iklan}/update', [IklanController::class, 'update'])->name('update');
    Route::delete('/{iklan}/hapus', [IklanController::class, 'destroy'])->name('destroy');
});
Route::get('/', [Controller::class, 'home'])->name('home');
Route::get('/postingan/{slug}', [Controller::class, 'detail'])->name('posts.show');
Route::get('/tentang-kami', [Controller::class, 'about'])->name('about');
Route::get('/kategori-berita', [Controller::class, 'categories'])->name('categories');

Route::get('/auth', [UserController::class, 'auth'])->name('login');
Route::post('/auth/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/auth/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/auth/register', [RegisterController::class, 'register']);
Route::post('/auth/logout', [UserController::class, 'logout'])->name('logout');

Route::get('login/google/slug', [GoogleController::class, 'setPostSlug'])->name('login.google.slug');
Route::get('login/google/redirect', [GoogleController::class, 'redirectToGoogle'])
    ->middleware(['guest'])
    ->name('login.google');
Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback'])
    ->middleware(['guest'])
    ->name('callback');

    // Bisa diakses oleh semua user yang login (admin & member)
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::prefix('manajemen-postingan')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post:slug}/update', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post:slug}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    });
    // Hanya Bisa di Akses Oleh admin
    Route::group(['middleware' => ['auth', 'is_admin']], function () {

    Route::prefix('manajemen-kategori')->group( function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{slug}/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{slug}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    Route::prefix('breaking-news')->group(function () {
        Route::get('/', [BreakingNewsController::class, 'index'])->name('breaking-news.index');
        Route::post('/store', [BreakingNewsController::class, 'store'])->name('breaking-news.store');
        Route::delete('/{id}/delete', [BreakingNewsController::class, 'destroy'])->name('breaking-news.destroy');
    });


    Route::prefix('komentar')->group(function () {
        Route::get('/', [CommentController::class,'index'])->name('comments.index');
        Route::post('/store', [CommentController::class,'store'])->name('comments.store');
        Route::delete('/{id}/delete', [CommentController::class,'destroy'])->name('comments.destroy');
    });

    Route::prefix('manajemen-tentang-kami')->group(function () {
       Route::get('/', [AboutController::class, 'index'])->name('about.index');
       Route::get('/creator', [AboutController::class, 'creator'])->name('about.creator');
       Route::put('/update/{id}', [AboutController::class, 'update'])->name('about.update');
    });

    Route::prefix('video')->group(function () {
        Route::get('/', [VideoController::class, 'index'])->name('videos.index');
        Route::post('/store', [VideoController::class, 'store'])->name('videos.store');
        Route::delete('/{id}/delete', [VideoController::class, 'destroy'])->name('videos.destroy');
    });

    Route::prefix('manajemen-user')->group(function () {
        Route::get('/', [UserController::class, 'manage'])->name('users.manage');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user:username}/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    });

    
    Route::get('/statistik',[StatistikController::class, 'index'])->name('statistik.index');

});

