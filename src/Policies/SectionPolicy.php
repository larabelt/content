<?php

namespace Belt\Content\Policies;

use Belt\Core\Behaviors\TeamableInterface;
use Belt\Core\User;
use Belt\Core\Policies\BaseAdminPolicy;
use Belt\Content\Section;

/**
 * Class SectionPolicy
 * @package Belt\Content\Policies
 */
class SectionPolicy extends BaseAdminPolicy
{
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

    /**
     * Determine whether the user can update the object.
     *
     * @param  User $auth
     * @param  mixed $arguments
     * @return mixed
     */
    public function update(User $auth, $arguments = null)
    {
        if ($arguments instanceof Section) {
            $owner = $arguments->owner;
            if ($owner && $owner instanceof TeamableInterface) {
                return $this->ofTeam($auth, $owner->team);
            }
        }
    }
}