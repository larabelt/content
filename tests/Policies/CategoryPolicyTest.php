<?php

use Ohio\Core\Testing;
use Ohio\Content\Policies\CategoryPolicy;

class CategoryPolicyTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Ohio\Content\Policies\CategoryPolicy::index
     * @covers \Ohio\Content\Policies\CategoryPolicy::view
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