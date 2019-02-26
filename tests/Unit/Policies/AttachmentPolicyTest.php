<?php namespace Tests\Belt\Content\Unit\Policies;

use Tests\Belt\Core;
use Belt\Content\Policies\AttachmentPolicy;

class AttachmentPolicyTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\AttachmentPolicy::view
     * @covers \Belt\Content\Policies\AttachmentPolicy::create
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new AttachmentPolicy();

        # create
        $this->assertNotTrue($policy->create($user));
        $this->assertNotEmpty($policy->create($this->getUser('team')));

        # view
        $this->assertTrue($policy->view($user, 1));
    }

}