<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index($collectionId){
      $collection = \App\Models\Collection::findOrFail($collectionId);

      return view('items.dashboard', [
          'collection' => $collection,
          'items'=>$collection->items,
      ]);
    }

    public function store($collectionId, \Illuminate\Http\Request $request){
      $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
          'title' => 'required|max:255',
          'description'=>'required',
          'item-image'=>'required|image|mimes:jpeg,png,jpg,gif',
      ]);

      if ($validator->fails()) {
          return redirect()->route('dashboard')->withInput()->withErrors($validator);
      }

      $file = $request->file('item-image')->store('items','public');

      \App\Models\CollectionItem::create([
          'collection_id'=>$collectionId,
          'title' => $request->title,
          'description' => $request->description,
          'file_path'=>$file,
      ]);
      return redirect()->route('collection.item.index',$collectionId);
    }

    public function destroy($collectionId, $itemId){
      \App\Models\CollectionItem::findOrFail($itemId)->delete();

      return redirect()->route('collection.item.index',$collectionId);
    }

    public function edit($collectionId,$itemId){
      $item = \App\Models\CollectionItem::findOrFail($itemId);

      return view('items.edit', [
          'item' => $item,
          'collection'=>$item->collection,
      ]);
    }

    public function update($collectionId,$itemId, \Illuminate\Http\Request $request){
      $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
          'title' => 'required|max:255',
          'description'=>'required',
          'item-image'=>'image|mimes:jpeg,png,jpg,gif',
      ]);

      if ($validator->fails()) {
          return redirect()->route('dashboard')->withInput()->withErrors($validator);
      }

      $item = \App\Models\CollectionItem::findOrFail($itemId);

      if ($request->file('item-image') == null){
        $file = $item->file_path;
      }
      else{
        $file = $request->file('item-image')->store('items','public');
      }

      $item->update([
          'title' => $request->title,
          'description' => $request->description,
          'file_path'=>$file,
      ]);

      return redirect()->route('collection.item.index',$collectionId);
    }
}
