<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class FasilityPolicy
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
            : Response::deny("Hanya pimpinan dan staff yang dapat menambahkan fasilitas");
    }

    public function patch(User $user)
    {
        $allowedRoles = ['Pimpinan', 'Staff'];

        return in_array($user->role, $allowedRoles)
            ? Response::allow()
            : Response::deny("Hanya pimpinan dan staff yang dapat mengedit fasilitas");
    }

    public function delete(User $user)
    {
        return ($user->role == "Pimpinan")
            ? Response::allow()
            : Response::deny("Hanya pimpinan yang dapat menghapus fasilitas");
    }
}
