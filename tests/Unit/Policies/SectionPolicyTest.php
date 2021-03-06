<?php namespace Tests\Belt\Content\Unit\Policies;

use Belt\Core\Behaviors\Teamable;
use Belt\Core\Behaviors\TeamableInterface;
use Belt\Core\Tests;
use Belt\Core\Team;
use Belt\Content\Section;
use Belt\Content\Policies\SectionPolicy;

class SectionPolicyTest extends Tests\BeltTestCase
{

    use Tests\CommonMocks;

    /**
     * @covers \Belt\Content\Policies\SectionPolicy::view
     * @covers \Belt\Content\Policies\SectionPolicy::update
     */
    public function test()
    {
        $user = $this->getUser();

        $policy = new SectionPolicy();

        # view
        $this->assertTrue($policy->view($user, 1));

        # update
        $stub = new SectionPolicyStub();
        $section = factory(Section::class)->make();
        $section->owner = $stub;
        $teamUser = $this->getUser('team');
        $stub->team = $teamUser->teams->first();

        $this->assertEmpty($policy->update($user, $section));
        $this->assertNotEmpty($policy->update($teamUser, $section));
    }

}

class SectionPolicyStub extends Tests\BaseModelStub implements
    TeamableInterface
{
    use Teamable;

}