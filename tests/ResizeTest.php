<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Attachment;
use Belt\Content\Resize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResizeTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Resize::attachment
     * @covers \Belt\Content\Resize::getPresetAttribute
     * @covers \Belt\Content\Resize::getNicknameAttribute
     */
    public function test()
    {
        $attachment = factory(Attachment::class)->make();
        $resize = factory(Resize::class)->make(['attachment' => $attachment, 'width' => 100, 'height' => 100]);

        # attachment
        $this->assertInstanceOf(BelongsTo::class, $resize->attachment());

        # preset
        $this->assertEquals('100:100', $resize->preset);

        # nickname
        $this->assertEquals('100:100', $resize->nickname);
        $resize->setAttribute('nickname', 'test');
        $this->assertEquals('test', $resize->nickname);
    }

}