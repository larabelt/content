<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\SearchEngines\ElasticEngine;
use Belt\Content\Services\ElasticService;
use Elasticsearch\Namespaces\IndicesNamespace;
use Elasticsearch\Client as Elastic;
use Illuminate\Contracts\Filesystem\Filesystem;

class ElasticServiceTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Services\ElasticService::__construct
     * @covers \Belt\Content\Services\ElasticService::elastic
     * @covers \Belt\Content\Services\ElasticService::engine
     * @covers \Belt\Content\Services\ElasticService::indices
     * @covers \Belt\Content\Services\ElasticService::disk
     * @covers \Belt\Content\Services\ElasticService::writeConfig
     * @covers \Belt\Content\Services\ElasticService::deleteIndex
     * @covers \Belt\Content\Services\ElasticService::createIndex
     * @covers \Belt\Content\Services\ElasticService::getSettings
     * @covers \Belt\Content\Services\ElasticService::getMappings
     * @covers \Belt\Content\Services\ElasticService::putMappings
     * @covers \Belt\Content\Services\ElasticService::import
     */
    public function test()
    {
        app()['config']->set('belt.elastic.index.name', 'test');
        app()['config']->set('belt.elastic.mappings', [
            'pages' => [],
            'posts' => [],
        ]);

        $service = new ElasticService();

        # elastic
        $elastic = m::mock(Elastic::class);
        $service->elastic = $elastic;
        $this->assertEquals($elastic, $service->elastic());

        # engine
        $engine = m::mock(ElasticEngine::class);
        $service->engine = $engine;
        $this->assertEquals($engine, $service->engine());

        # indices
        $indices = m::mock(IndicesNamespace::class);
        $elastic->shouldReceive('indices')->andReturn($indices);
        $this->assertEquals($indices, $service->indices());

        # disk
        $disk = m::mock(Filesystem::class);
        $service->disk = $disk;
        $this->assertEquals($disk, $service->disk());

        # writeConfig
        $path = 'path\to\config';
        $array = ['foo' => 'bar'];
        $disk->shouldReceive('put')->matchArgs([$path])->andReturnSelf();
        $service->writeConfig($path, $array);

        # deleteIndex
        $indices = m::mock(IndicesNamespace::class);
        $indices->shouldReceive('delete')->with(['index' => 'test'])->andReturnSelf();
        $service->indices = $indices;
        $service->index = 'test';
        $service->deleteIndex();

        # deleteIndex (fail)
        $indices = m::mock(IndicesNamespace::class);
        $indices->shouldReceive('delete')->with(['index' => 'invalid'])->andThrow(new \Exception());
        $service->indices = $indices;
        $service->index = 'invalid';
        $service->deleteIndex();

        # createIndex
        $indices = m::mock(IndicesNamespace::class);
        $indices->shouldReceive('create')->andReturnSelf();
        $indices->shouldReceive('putMapping')->andReturn([]);
        $service->indices = $indices;
        $service->createIndex();

        # createIndex (fail)
        $indices = m::mock(IndicesNamespace::class);
        $indices->shouldReceive('create')->andThrow(new \Exception());
        $service->indices = $indices;
        $service->createIndex();

        # getSettings
        $settings = ['test' => ['settings' => ['foo' => 'bar']]];
        $indices = m::mock(IndicesNamespace::class);
        $indices->shouldReceive('getSettings')->andReturn($settings);
        $service->index = 'test';
        $service->indices = $indices;
        $disk->shouldReceive('put')->matchArgs(['config/belt/elastic/settings.php'])->andReturnSelf();
        $service->getSettings();

        # getMappings
        $mappings = ['test' => ['mappings' => [
            'pages' => ['foo' => 'bar'],
            'posts' => ['foo' => 'bar'],
        ]]];
        $indices = m::mock(IndicesNamespace::class);
        $indices->shouldReceive('getMapping')->andReturn($mappings);
        $service->indices = $indices;
        $disk->shouldReceive('put')->with('config/belt/elastic/mappings/pages.php', ['foo'=>'bar'])->andReturnSelf();
        $disk->shouldReceive('put')->with('config/belt/elastic/mappings/posts.php', ['foo'=>'bar'])->andReturnSelf();
        $service->getMappings();

        # import

    }

}
