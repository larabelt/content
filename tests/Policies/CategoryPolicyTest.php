<?php

use Belt\Core\Testing;
use Belt\Content\Policies\CategoryPolicy;

class CategoryPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\CategoryPolicy::index
     * @covers \Belt\Content\Policies\CategoryPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new CategoryPolicy();

        # index
        $this->assertTrue($policy->index($user, 1));

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}