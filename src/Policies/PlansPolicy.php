<?php

namespace SauloSilva\Plans\Policies;

use App\User;
//use SauloSilva\Plans\Models\Plan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlansPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return $this->check();
    }

    public function create(User $user)
    {
        return $this->check();
    }

    public function update(User $user)
    {
        return $this->check();
    }

    public function delete(User $user)
    {
        return $this->check();
    }

    protected function check()
    {
        $arr = ['plans-per-type'];

        $path = basename(request()->getPathInfo());

        return in_array($path, $arr) === false;
    }

//
//
//
//restore
//forceDelete
}
