<?php

namespace Ohio\Content\Policies;

use Ohio\Core\User;
use Ohio\Core\Policies\BaseAdminPolicy;
use Ohio\Content\Tag;

class TagPolicy extends BaseAdminPolicy
{
    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @param  Tag $object
     * @return mixed
     */
    public function view(User $auth, $object)
    {
        return true;
    }
}