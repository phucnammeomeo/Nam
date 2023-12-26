<?php

namespace App\Policies;

use App\Models\Keyword;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeyWordPolicy
{
    use HandlesAuthorization;
    
    public function index(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.keywords.index'));
    }

    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.keywords.create'));
    }

    public function edit(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.keywords.edit'));
    }

    public function destroy(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.keywords.destroy'));
    }

}
