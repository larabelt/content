<?php namespace Tests\Belt\Content\Unit\Jobs;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Term;
use Belt\Content\Jobs\UpdateTermData;
use Illuminate\Database\Eloquent\Collection;

class UpdateTermDataTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Jobs\UpdateTermData::__construct
     * @covers \Belt\Content\Jobs\UpdateTermData::handle
     * @covers \Belt\Content\Jobs\UpdateTermData::__handle
     */
    public function test()
    {
        $term1 = new UpdateTermDataTestStub();
        $term1->children = new Collection([new UpdateTermDataTestStub()]);

        $job = new UpdateTermData($term1);
        $job->handle();
    }

}

class UpdateTermDataTestStub extends Term
{

    public function getNestedNames()
    {
        return ['name'];
    }

    public function getNestedSlugs()
    {
        return ['name'];
    }

    public function save(array $options = [])
    {

    }

}