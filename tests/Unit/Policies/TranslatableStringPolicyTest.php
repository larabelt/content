<?php namespace Tests\Belt\Content\Unit\Policies;

use Belt\Core\Tests;
use Belt\Content\Policies\TranslatableStringPolicy;

class TranslatableStringPolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

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