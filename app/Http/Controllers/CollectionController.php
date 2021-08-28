<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(){
      $collections = \App\Models\Collection::orderBy('created_at', 'asc')->paginate(10);
      $this->authorize('index', \App\Models\Collection::class);
      return view('collection.dashboard', [
          'collections' => $collections
      ]);
    }

    public function store(Request $request){
      $this->authorize('store', \App\Models\Collection::class);

      $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
          'title' => 'required|max:255',
          'description'=>'required',
          'collection-image'=>'required|image|mimes:jpeg,png,jpg,gif',
      ]);

      if ($validator->fails()) {
          return redirect()->route('dashboard')->withInput()->withErrors($validator);
      }

      $file = $request->file('collection-image')->store('collections','public');

      \App\Models\Collection::create([
          'user_id'=> auth()->id(),
          'title' => $request->title,
          'description' => $request->description,
          'file_path'=>$file,
      ]);

      return redirect()->route('dashboard');
    }

    public function destroy($collectionId){
      $collection = \App\Models\Collection::findOrFail($collectionId);
      $this->authorize('destroy', $collection);
      $collection->delete();

      return redirect()->route('dashboard');
    }

    public function edit($collectionId){
      $collection = \App\Models\Collection::findOrFail($collectionId);
      $this->authorize('edit', $collection);

      return view('collection.edit', [
          'collection' => $collection,
          'items'=>$collection->items,
      ]);
    }

    public function update($collectionId, Request $request){
      $collection = \App\Models\Collection::findOrFail($collectionId);
      $this->authorize('update', $collection);

      $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
          'title' => 'required|max:255',
          'description'=>'required',
          'collection-image'=>'image|mimes:jpeg,png,jpg,gif',
      ]);

      if ($validator->fails()) {
          return redirect()->route('dashboard')->withInput()->withErrors($validator);
      }

      if ($request->file('collection-image') == null){
        $file = $collection->file_path;
      }
      else{
        $file = $request->file('collection-image')->store('collections','public');
      }

      $collection->update([
          'title' => $request->title,
          'description' => $request->description,
          'file_path'=>$file,
      ]);

      return redirect()->route('dashboard');
    }

}
