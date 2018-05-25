<?php

use Belt\Core\Testing;
use Belt\Spot\Policies\ItineraryPolicy;

class ItineraryPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Spot\Policies\ItineraryPolicy::view
     * @covers \Belt\Spot\Policies\ItineraryPolicy::create
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new ItineraryPolicy();

        # create
        $this->assertNotTrue($policy->create($user));
        $this->assertNotEmpty($policy->create($this->getUser('team')));

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}