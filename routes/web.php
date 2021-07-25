<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Display All Tasks
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $collections = \App\Models\Collection::orderBy('created_at', 'asc')->get();

    return view('dashboard', [
        'collections' => $collections
    ]);
})->middleware(['auth'])->name('dashboard');

/**
 * Add A New Task
 */
Route::post('/collection', function (\Illuminate\Http\Request $request) {
    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description'=>'required',
    ]);

    if ($validator->fails()) {
        return redirect('/dashboard')
            ->withInput()
            ->withErrors($validator);
    }

    \App\Models\Collection::create([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect('/dashboard');
});

/**
 * Delete An Existing Task
 */
Route::delete('/collection/{id}', function ($id) {
    \App\Models\Collection::findOrFail($id)->delete();

    return redirect('/dashboard');
});

require __DIR__.'/auth.php';
