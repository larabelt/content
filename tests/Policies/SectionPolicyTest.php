<?php

use Belt\Core\Behaviors\Teamable;
use Belt\Core\Behaviors\TeamableInterface;
use Belt\Core\Testing;
use Belt\Content\Page;
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

        # update (non-teamable section object)
        $section = factory(Section::class)->make();
        $policy->update($user, $section);

        # update (teamable section object)
        $user = $this->getUser('team');
        $team = $user->teams->first();
        $stub = new SectionPolicyTestStub($team);
        $section = factory(Section::class)->make();
        $section->owner = $stub;
        $policy->update($user, $section);

    }

}

class SectionPolicyTestStub implements TeamableInterface
{

    use Teamable;

    public function __construct($team)
    {
        $this->team = $team;
    }

}