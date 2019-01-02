<?php

use Belt\Core\Testing;
use Belt\Content\Policies\TranslatableStringPolicy;

class TranslatableStringPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\TranslatableStringPolicy::view
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new TranslatableStringPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}