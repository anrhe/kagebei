<?php

namespace App\Policies;

use App\Models\Gereja;
use App\Models\User;

class GerejaPolicy
{
    /**
     * Determine whether the user can view any models (list all gereja).
     */
    public function viewAny(User $user): bool
    {
        // Only "admin" can view all gereja
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model (specific gereja).
     */
    public function view(User $user, Gereja $gereja): bool
    {
        // All users can view a specific gereja
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only "admin" can create a gereja
        info("User role: " . $user->role);
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Gereja $gereja): bool
    {
        // Only "admin" can update a gereja
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gereja $gereja): bool
    {
        // Only "admin" can delete a gereja
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gereja $gereja): bool
    {
        // Only "admin" can restore a gereja
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gereja $gereja): bool
    {
        // Only "admin" can permanently delete a gereja
        return $user->role === 'admin';
    }
}
