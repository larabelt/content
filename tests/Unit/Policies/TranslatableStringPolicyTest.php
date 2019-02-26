<?php namespace Tests\Belt\Content\Unit\Policies;

use Tests\Belt\Core;
use Belt\Content\Policies\TranslatableStringPolicy;

class TranslatableStringPolicyTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

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