<?php

use Ohio\Core\Base\Testing\OhioTestCase;
use Ohio\Content\Handle\Handle;

class HandleTest extends OhioTestCase
{
    /**
     * @covers \Ohio\Content\Handle\Handle::__toString
     * @covers \Ohio\Content\Handle\Handle::setIsActiveAttribute
     * @covers \Ohio\Content\Handle\Handle::setTemplateAttribute
     * @covers \Ohio\Content\Handle\Handle::setIntroAttribute
     * @covers \Ohio\Content\Handle\Handle::setBodyAttribute
     * @covers \Ohio\Content\Handle\Handle::setExtraAttribute
     */
    public function test()
    {
        $handle = factory(Handle::class)->make();
        $handle->is_active = 1;
        $handle->name = ' Test ';
        $handle->template = ' TEST ';
        $handle->intro = ' Test ';
        $handle->body = ' Test ';
        $handle->extra = ' Test ';



        $this->assertTrue($handle->is_active);
        $this->assertEquals($handle->name, $handle->__toString());
        $this->assertEquals('test', $handle->template);
        $this->assertEquals('Test', $handle->intro);
        $this->assertEquals('Test', $handle->body);
        $this->assertEquals('Test', $handle->extra);
    }

}