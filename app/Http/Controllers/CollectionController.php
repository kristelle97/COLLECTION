<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CollectionController extends Controller
{
    public function index(Request $request){
      $collections = $request->user()->collections()->paginate(10);
      $this->authorize('index', \App\Models\Collection::class);

      $path = storage_path('json/collectiontypes.json');
      $json = trim(file_get_contents($path));
      $tags = json_decode($json, true);


      return view('collection.dashboard', [
          'collections' => $collections,
          'tags' => $tags,
      ]);
    }

    public function display_collections(Request $request){
      $collections = \App\Models\Collection::when($request->has('tag'),function($query) use ($request){
        return $query->where('tag',$request->tag);
      })->orderBy('created_at', 'asc')->paginate(10);
      $this->authorize('display_collections', \App\Models\Collection::class);
      $path = storage_path('json/collectiontypes.json');
      $json = trim(file_get_contents($path));
      $tags = json_decode($json, true);
      return view('collection.index', [
          'collections' => $collections,
          'tags' => $tags,
      ]);
    }

    public function store(Request $request){

      $path = storage_path('json/collectiontypes.json');
      $json = trim(file_get_contents($path));
      $tags = json_decode($json, true);

      $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
          'title' => 'required|max:255',
          'description'=>'required',
          'tag'=>['required',in_array($request->tag,$tags)],
          'collection-image'=>'required|image|mimes:jpeg,png,jpg,gif',
      ]);

      if ($validator->fails()) {
          return redirect()->route('dashboard')->withInput()->withErrors($validator);
      }

      $file = $request->file('collection-image')->store('collections','public');

      $collection = new \App\Models\Collection([
          'user_id'=> auth()->id(),
          'title' => $request->title,
          'description' => $request->description,
          'tag'=> $request->tag,
          'file_path'=>$file,
      ]);
      $this->authorize('store', $collection);
      $collection->save();

      return redirect()->route('dashboard');
    }

    public function destroy($collectionId){
      $collection = \App\Models\Collection::findOrFail($collectionId);
      $this->authorize('destroy', $collection);
      $collection->delete();

      return redirect()->back();
    }

    public function edit($collectionId){
      $collection = \App\Models\Collection::findOrFail($collectionId);
      $this->authorize('edit', $collection);

      $path = storage_path('json/collectiontypes.json');
      $json = trim(file_get_contents($path));
      $tags = json_decode($json, true);

      return view('collection.edit', [
          'collection' => $collection,
          'items'=>$collection->items,
          'tags'=> $tags,
      ]);
    }

    public function update($collectionId, Request $request){
      $collection = \App\Models\Collection::findOrFail($collectionId);
      $this->authorize('update', $collection);

      $path = storage_path('json/collectiontypes.json');
      $json = trim(file_get_contents($path));
      $tags = json_decode($json, true);

      $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
          'title' => 'required|max:255',
          'description'=>'required',
          'tag'=>['required',in_array($request->tag,$tags)],
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
          'tag'=> $request->tag,
          'file_path'=>$file,
      ]);

      flash('Collection Updated Successfully')->success();

      return redirect()->route('dashboard');
    }

    public function toggle_like($collectionId){
      $collection = \App\Models\Collection::findOrFail($collectionId);
      $this->authorize('toggle_like', $collection);
      if ($collection->liked()){
        $collection->unlike();
      }
      else{
        $collection->like();
      }
      return redirect()->back();
    }
  }
