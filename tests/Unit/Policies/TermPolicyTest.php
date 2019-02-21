<?php namespace Tests\Belt\Content\Unit\Policies;

use Belt\Core\Tests;
use Belt\Content\Policies\TermPolicy;

class TermPolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

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