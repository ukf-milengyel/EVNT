<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Event $event)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->group == NULL) return false;
        return $user->group->permissions & 0b10 || AdminPolicy::isAdmin($user);
    }

    public function createAnnouncement (User $user, Event $event){
        return AdminPolicy::isAdmin($user) ||
            $user->group != NULL &&
            $user->group->permissions & 0b10000 &&
            $event->user()->is($user);
    }

    public function createImage(User $user, Event $event){
        return AdminPolicy::isAdmin($user) ||
            $user->group != NULL &&
            $user->group->permissions & 0b100 &&
            $event->user()->is($user);
    }

    public function createAttachment(User $user, Event $event){
        return AdminPolicy::isAdmin($user) ||
            $user->group != NULL &&
            $user->group->permissions & 0b1000 &&
            $event->user()->is($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Event $event)
    {
        return
            AdminPolicy::isAdmin($user) ||
            $event->user()->is($user)
            && $this->create($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Event $event)
    {
        return
            AdminPolicy::isAdmin($user) ||
            $event->user()->is($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Event $event)
    {
        return $this->update($user, $event);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Event $event)
    {
        return $this->update($user, $event);
    }
}
