<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
Route::get('/', function () {return view('welcome');});

Route::group(['middleware' => ['auth']], function(){

    //show all posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    //create new post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    //restore deleted post
    Route::get('/posts/restore', [PostController::class, 'restore'])->name('posts.restore');
    //show specific post and related comments
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    //update specific post
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    //remove post
    Route::delete('/posts/{post})', [PostController::class, 'destroy'])->name('posts.destroy');
    //for comments
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{commentId}/edit',[CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');




});




use Laravel\Socialite\Facades\Socialite;

Route::get('github/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');

Route::get('github/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
    ]);

    Auth::login($user);

    return redirect('/');
});


    Route::get('google/auth/redirect', function () {
        return Socialite::driver('google')->redirect();
    })->name('login.google');

    Route::get('google/auth/callback', function () {
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'email' => $googleUser->email,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
        ]);

        Auth::login($user);

        return redirect('/');
    });






    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');














// use Laravel\Socialite\Facades\Socialite;

// Route::get('/auth/redirect', function () {
//     return Socialite::driver('github')->redirect();
// });

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('github')->user();

//     // $user->token
// });
