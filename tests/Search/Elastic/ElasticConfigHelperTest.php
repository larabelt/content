<?php

use Belt\Content\Search\Elastic\ElasticConfigHelper;

class ElasticConfigHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Belt\Content\Search\Elastic\ElasticConfigHelper::analyzer
     * @covers \Belt\Content\Search\Elastic\ElasticConfigHelper::normalizer
     * @covers \Belt\Content\Search\Elastic\ElasticConfigHelper::property
     */
    public function test()
    {
        $helper = new ElasticConfigHelper();

        $this->assertEmpty($helper->analyzer('test'));
        $this->assertEmpty($helper->normalizer('test'));
        $this->assertEmpty($helper->property('test'));
    }


}