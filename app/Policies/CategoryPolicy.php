<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        $allowedRoles = ['Pimpinan', 'Staff'];

        return in_array($user->role, $allowedRoles)
            ? Response::allow()
            : Response::deny("Hanya pimpinan dan staff yang dapat membuat kategori");
    }

    public function patch(User $user)
    {
        $allowedRoles = ['Pimpinan', 'Staff'];

        return in_array($user->role, $allowedRoles)
            ? Response::allow()
            : Response::deny("Hanya pimpinan dan staff yang dapat mengedit kategori");
    }

    public function delete(User $user)
    {
        return ($user->role == "Pimpinan")
            ? Response::allow()
            : Response::deny("Hanya pimpinan yang dapat menghapus category");
    }
}
