<?php

use Belt\Content\Validators\AltUrlValidator;
use Belt\Core\Testing\BeltTestCase;

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
        /**
         * @todo make this assert false again. local testing is returning a 200 response for http://localhost/foo, where it did not before.
         */
        //$this->assertFalse($AltUrlValidator->altUrl('url', 'foo', [], $validator));
    }

}