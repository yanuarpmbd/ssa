<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PengeluaranPersediaan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengeluaranPersediaanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PengeluaranPersediaan  $pengeluaranPersediaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PengeluaranPersediaan $pengeluaranPersediaan)
    {
        return $user->can('view_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PengeluaranPersediaan  $pengeluaranPersediaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PengeluaranPersediaan $pengeluaranPersediaan)
    {
        return $user->can('update_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PengeluaranPersediaan  $pengeluaranPersediaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PengeluaranPersediaan $pengeluaranPersediaan)
    {
        return $user->can('delete_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PengeluaranPersediaan  $pengeluaranPersediaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PengeluaranPersediaan $pengeluaranPersediaan)
    {
        return $user->can('force_delete_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PengeluaranPersediaan  $pengeluaranPersediaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PengeluaranPersediaan $pengeluaranPersediaan)
    {
        return $user->can('restore_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PengeluaranPersediaan  $pengeluaranPersediaan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function replicate(User $user, PengeluaranPersediaan $pengeluaranPersediaan)
    {
        return $user->can('replicate_pengeluaran::persediaan');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_pengeluaran::persediaan');
    }

}
