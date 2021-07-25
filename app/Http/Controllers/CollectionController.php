<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    // request http -> router -> controller
    public function store(Request $request){
        return $request->all();
    }

    // collections: user_id
    // items: collection_id

    public function deleteItem($id){
        DB::delete('delete from collections where id=values(?)',$id);
    }

    public function updateItem($id,$title,$description){
//        comment je fais pour faire mettre un placeholder?
        DB::update('update collections set title=$title and description=$description where id=$id');
    }
}
