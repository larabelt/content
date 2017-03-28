<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Behaviors\HasSections;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\DB;

class HasSectionsTest extends BeltTestCase
{

    /**
     * @covers \Belt\Content\Behaviors\HasSections::sections
     * @covers \Belt\Content\Behaviors\HasSections::purgeSections
     */
    public function test()
    {
        # sections
        $stub = new HasSectionsTestStub();
        $this->assertInstanceOf(MorphMany::class, $stub->sections());

        # purgeTags
        $stub->id = 1;
        DB::shouldReceive('connection')->once()->andReturnSelf();
        DB::shouldReceive('table')->once()->with('sections')->andReturnSelf();
        DB::shouldReceive('where')->once()->with('owner_id', 1)->andReturnSelf();
        DB::shouldReceive('where')->once()->with('owner_type', 'HasSectionsTestStub')->andReturnSelf();
        DB::shouldReceive('delete')->once()->andReturnSelf();
        $stub->purgeSections();
    }

}

class HasSectionsTestStub extends Model
{
    use HasSections;
}