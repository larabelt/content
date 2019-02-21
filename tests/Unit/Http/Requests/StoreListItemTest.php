<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Content\Http\Requests\StoreListItem;

class StoreListItemTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreListItem::rules
     */
    public function test()
    {

        $request = new StoreListItem();

        $this->assertNotEmpty($request->rules());
    }

}