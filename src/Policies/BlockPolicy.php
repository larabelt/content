<?php

namespace Ohio\Content\Policies;

use Ohio\Core\User;
use Ohio\Core\Policies\BaseAdminPolicy;
use Ohio\Content\Block;

class BlockPolicy extends BaseAdminPolicy
{
    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @param  Block $object
     * @return mixed
     */
    public function view(User $auth, $object)
    {
        return true;
    }
}