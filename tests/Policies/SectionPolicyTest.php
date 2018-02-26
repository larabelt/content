<?php

use Belt\Core\Behaviors\Teamable;
use Belt\Core\Behaviors\TeamableInterface;
use Belt\Core\Testing;
use Belt\Core\Team;
use Belt\Content\Section;
use Belt\Content\Policies\SectionPolicy;

class SectionPolicyTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

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
        $this->assertNotTrue($policy->update($user, $section));

        Team::unguard();
        $team = factory(Team::class)->make(['id' => 123]);
        $user->teams->add($team);
        $stub->team = $team;
        $this->assertTrue($policy->update($user, $section));
    }

}

class SectionPolicyStub extends Testing\BaseModelStub implements
    TeamableInterface
{
    use Teamable;

}