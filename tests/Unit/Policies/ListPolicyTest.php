<?php namespace Tests\Belt\Content\Unit\Policies;

use Belt\Core\Tests;
use Belt\Content\Policies\ListPolicy;

class ListPolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\ListPolicy::view
     * @covers \Belt\Content\Policies\ListPolicy::create
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