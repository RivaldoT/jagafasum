<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
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
        $allowedRoles = ['Pimpinan', 'Warga'];

        return in_array($user->role, $allowedRoles)
            ? Response::allow()
            : Response::deny("Hanya pimpinan dan warga yang dapat menambahkan laporan");
    }

    public function patch(User $user)
    {
        $allowedRoles = ['Pimpinan', 'Staff'];

        return in_array($user->role, $allowedRoles)
            ? Response::allow()
            : Response::deny("Hanya Pimpinan dan staff yang dapat mengedit laporan");
    }

    public function delete(User $user)
    {
        return ($user->role == "Pimpinan")
            ? Response::allow()
            : Response::deny("Hanya pimpinan yang dapat menghapus laporan");
    }
}
