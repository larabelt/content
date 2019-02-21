<?php namespace Tests\Belt\Content\Unit\Policies;

use Belt\Core\Tests;
use Belt\Content\Policies\PagePolicy;

class PagePolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\PagePolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new PagePolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}