<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Collection;

class CollectionPolicy
{
    use HandlesAuthorization;

    public function index (User $user) {
        return true;
    }

    public function store (User $user) {
        return true;
    }

    public function edit (User $user, Collection $collection) {
        return $user->id == $collection->user_id;
    }

    public function update (User $user, Collection $collection) {
        return $user->id == $collection->user_id;
    }

    public function destroy (User $user, Collection $collection) {
        return $user->id == $collection->user_id;
    }
}
