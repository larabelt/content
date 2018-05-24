<?php

namespace Belt\Content\Policies;

use Belt\Core\User;
use Belt\Core\Policies\BaseAdminPolicy;
use Belt\Content\Term;

/**
 * Class TermPolicy
 * @package Belt\Content\Policies
 */
class TermPolicy extends BaseAdminPolicy
{
    /**
     * Determine whether the user can view the object.
     *
     * @param  User $auth
     * @param  Term $arguments
     * @return mixed
     */
    public function view(User $auth, $arguments = null)
    {
        return true;
    }
}