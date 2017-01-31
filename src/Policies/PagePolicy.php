<?php

namespace Ohio\Content\Policies;

use Ohio\Core\User;
use Ohio\Core\Policies\BaseAdminPolicy;
use Ohio\Content\Page;

class PagePolicy extends BaseAdminPolicy
{
    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @param  Page $object
     * @return mixed
     */
    public function index(User $auth, $object)
    {
        return true;
    }

    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @param  Page $object
     * @return mixed
     */
    public function view(User $auth, $object)
    {
        return true;
    }
}