<?php

use Ohio\Core\Testing;
use Ohio\Content\Policies\PagePolicy;

class PagePolicyTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Ohio\Content\Policies\PagePolicy::index
     * @covers \Ohio\Content\Policies\PagePolicy::view
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