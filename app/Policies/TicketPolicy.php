<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Sgcomptech\FilamentTicketing\Interfaces\TicketPolicies;
use Sgcomptech\FilamentTicketing\Models\Ticket;

class TicketPolicy implements TicketPolicies
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
        return $user->can('view_any_ticket');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Ticket $ticket)
    {
        return $user->can('manage all tickets')
        || $user->can('assign tickets')
        || ($user->can('manage assigned tickets') && $ticket->assigned_to_id == $user->id)
        || $ticket->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_ticket');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ticket $ticket)
    {
        return $user->can('manage all tickets')
            || $user->can('assign tickets')
            || ($user->can('manage assigned tickets') && $ticket->assigned_to_id == $user->id)
            || $ticket->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->can('delete_ticket');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_ticket');
    }

    public function manageAllTickets($user): bool
    {
        return $user->can('Manage All Tickets');
    }

    public function manageAssignedTickets($user): bool
    {
        return $user->can('Manage Assigned Tickets');
    }

    public function assignTickets($user): bool
    {
        return $user->can('Assign Tickets');
    }
}
