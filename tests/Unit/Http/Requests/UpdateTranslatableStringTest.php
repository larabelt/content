<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Content\Http\Requests\UpdateTranslatableString;

class UpdateTranslatableStringTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdateTranslatableString::rules
     */
    public function test()
    {
        $request = new UpdateTranslatableString();

        $this->assertNotEmpty($request->rules());
    }

}