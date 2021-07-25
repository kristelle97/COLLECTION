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
 * Display All Collections
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
 * Add A New Collection
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
 * Delete An Existing Collection
 */
Route::delete('/collection/{collectionId}', function ($collectionId) {
    \App\Models\Collection::findOrFail($collectionId)->delete();

    return redirect('/dashboard');
});

/**
 * Update An Existing Collection
 */
Route::get('/collection/{collectionId}', function ($collectionId) {
    $collection = \App\Models\Collection::findOrFail($collectionId);

    return view('edit_collection', [
        'collection' => $collection,
        'items'=>$collection->items,
    ]);
});

Route::put('/collection/{collectionId}', function ($collectionId, \Illuminate\Http\Request $request) {

    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description'=>'required',
    ]);

    if ($validator->fails()) {
        return redirect('/dashboard')
            ->withInput()
            ->withErrors($validator);
    }

    $collection = \App\Models\Collection::findOrFail($collectionId);

    $collection->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect('/dashboard');
});

/**
 * Add A New Item
 */
Route::post('/collection/{collectionId}/item', function ($collectionId, \Illuminate\Http\Request $request) {
    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description'=>'required',
    ]);

    if ($validator->fails()) {
        return redirect('/dashboard')
            ->withInput()
            ->withErrors($validator);
    }

    \App\Models\CollectionItem::create([
        'collection_id'=>$collectionId,
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect('/collection/'.$collectionId);
});

/**
 * Delete An Existing Item
 */
Route::delete('/collection/{collectionId}/item/{itemId}', function ($collectionId, $itemId) {
    \App\Models\CollectionItem::findOrFail($itemId)->delete();

    return redirect('/collection/'.$collectionId);
});

/**
 * Update An Existing Item
 */
Route::get('/collection/{collectionId}/item/{itemId}', function ($collectionId,$itemId) {
    $item = \App\Models\CollectionItem::findOrFail($itemId);

    return view('edit_item', [
        'item' => $item,
        'collection'=>$item->collection,
    ]);
});

Route::put('/collection/{collectionId}/item/{itemId}', function ($collectionId,$itemId, \Illuminate\Http\Request $request) {

    $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description'=>'required',
    ]);

    if ($validator->fails()) {
        return redirect('/dashboard')
            ->withInput()
            ->withErrors($validator);
    }

    $item = \App\Models\CollectionItem::findOrFail($itemId);

    $item->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect('/collection/'.$collectionId);
});

require __DIR__.'/auth.php';
