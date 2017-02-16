<?php

use Belt\Core\Testing;
use Belt\Content\Policies\PagePolicy;

class PagePolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\PagePolicy::index
     * @covers \Belt\Content\Policies\PagePolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new PagePolicy();

        # index
        $this->assertTrue($policy->index($user, 1));

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}