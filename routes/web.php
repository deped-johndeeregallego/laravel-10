<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    // return view('welcome');
   
    // $users = DB::select ("SELECT * from users where id='1'");
    // $users = DB::insert('insert into users(name, email, password) values (?, ?, ?)',['John', 'sample@gmail.com', 'password']);
    //  $users = DB::update("update users set email=? WHERE id=?", ['123@gmail.com',1]);
    // $users = DB:: delete("delete from users WHERE id=?", [1]);

    $users = DB::table('users')->get();
    
    // $users = DB::table('users')->where('id', 2)->get();
    // $users = User::create([
    //     'name' => 'new_johnq_pampers',
    //     'email' => '1233_john_pampers@gmail.com',
    //     'password' => '123456'
    // ]);

    // $users = DB::table('users')->where('id' , 3)->update(['email' => 'pampers1@gmail.com']);
    // $users = DB::table('users')->where('id', 3)->delete();
     dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
