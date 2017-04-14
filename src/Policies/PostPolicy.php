<?php

namespace Belt\Content\Policies;

use Belt\Core\User;
use Belt\Core\Policies\BaseAdminPolicy;
use Belt\Content\Post;

/**
 * Class PostPolicy
 * @package Belt\Content\Policies
 */
class PostPolicy extends BaseAdminPolicy
{
    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @return mixed
     */
    public function index(User $auth)
    {
        return true;
    }

    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @param  Post $object
     * @return mixed
     */
    public function view(User $auth, $object)
    {
        return true;
    }

}