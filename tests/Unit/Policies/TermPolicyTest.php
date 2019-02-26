<?php namespace Tests\Belt\Content\Unit\Policies;

use Tests\Belt\Core;
use Belt\Content\Policies\TermPolicy;

class TermPolicyTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\TermPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new TermPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}