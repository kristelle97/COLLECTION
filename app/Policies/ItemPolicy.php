<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\CollectionItem;

class ItemPolicy
{
    use HandlesAuthorization;

    public function index (User $user) {
        return true;
    }

    public function store (User $user, CollectionItem $item) {
        $collectionId = $item->collection_id;
        $collection = \App\Models\Collection::findOrFail($collectionId);
        return $user->id == $collection->user_id;
    }

    public function edit (User $user, CollectionItem $item) {
      $collectionId = $item->collection_id;
      $collection = \App\Models\Collection::findOrFail($collectionId);
      return $user->id == $collection->user_id;
    }

    public function update (User $user, CollectionItem $item) {
      $collectionId = $item->collection_id;
      $collection = \App\Models\Collection::findOrFail($collectionId);
      return $user->id == $collection->user_id;
    }

    public function destroy (User $user, CollectionItem $item) {
      $collectionId = $item->collection_id;
      $collection = \App\Models\Collection::findOrFail($collectionId);
      return $user->id == $collection->user_id;
    }

    public function toggle_like (User $user) {
        return true;
    }
}
