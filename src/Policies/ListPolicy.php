<?php

namespace Belt\Content\Policies;

use Belt\Core\User;
use Belt\Core\Policies\BaseAdminPolicy;
use Belt\Content\Lyst;

/**
 * Class ListPolicy
 * @package Belt\Content\Policies
 */
class ListPolicy extends BaseAdminPolicy
{
    /**
     * Determine whether the user can create object.
     *
     * @param  User $auth
     * @return mixed
     */
    public function create(User $auth, $arguments = null)
    {
        return $this->teamService()->team();
    }

    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @param  mixed $arguments
     * @return mixed
     */
    public function view(User $auth, $arguments = null)
    {
        return true;
    }
}