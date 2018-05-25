<?php

use Belt\Core\Testing;
use Belt\Spot\Policies\ListPolicy;

class ListPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Spot\Policies\ListPolicy::view
     * @covers \Belt\Spot\Policies\ListPolicy::create
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new ListPolicy();

        # create
        $this->assertNotTrue($policy->create($user));
        $this->assertNotEmpty($policy->create($this->getUser('team')));

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}