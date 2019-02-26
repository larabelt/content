<?php namespace Tests\Belt\Content\Unit\Policies;

use Tests\Belt\Core;
use Belt\Content\Policies\PagePolicy;

class PagePolicyTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

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