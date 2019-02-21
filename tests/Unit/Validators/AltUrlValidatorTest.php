<?php namespace Tests\Belt\Content\Unit\Validators;

use Belt\Content\Validators\AltUrlValidator;
use Belt\Core\Tests\BeltTestCase;

class AltUrlValidatorTest extends BeltTestCase
{

    /**
     * @covers \Belt\Content\Validators\AltUrlValidator::altUrl
     */
    public function test()
    {
        $validator = \Illuminate\Support\Facades\Validator::make([], ['url' => 'alt_url']);

        $AltUrlValidator = new AltUrlValidator();

        $this->assertTrue($AltUrlValidator->altUrl('url', 'http://google.com', [], $validator));
        $this->assertFalse($AltUrlValidator->altUrl('url', 'foo', [], $validator));
    }

}