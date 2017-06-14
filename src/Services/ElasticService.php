<?php

namespace Belt\Content\Services;

use Belt, Riimu;
use Belt\Core\Helpers\BeltHelper;
use Belt\Core\Helpers\MorphHelper;
use Belt\Content\SearchEngines\ElasticEngine;
use Elasticsearch\Client as Elastic;
use Laravel\Scout\EngineManager;

/**
 * Class ElasticService
 * @package Belt\Content\Services
 */
class ElasticService
{
    /**
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    public $disk;

    /**
     * @var Elastic
     */
    public $elastic;

    /**
     * @var ElasticEngine
     */
    public $engine;

    /**
     * @var string
     */
    public $index;

    /**
     * @var \Elasticsearch\Namespaces\IndicesNamespace
     */
    public $indices;

    /**
     * @var MorphHelper
     */
    public $morphHelper;

    public function __construct()
    {
        $this->index = config('belt.elastic.index.name');
        $this->morphHelper = new MorphHelper();
    }

    /**
     * @return Elastic
     */
    public function elastic()
    {
        return $this->elastic = $this->elastic ?: $this->engine()->elastic;
    }

    /**
     * @return ElasticEngine
     */
    public function engine()
    {
        return $this->engine = $this->engine ?: app(EngineManager::class)->driver('elastic');
    }

    /**
     * @return \Elasticsearch\Namespaces\IndicesNamespace
     */
    public function indices()
    {
        return $this->indices ?: $this->elastic()->indices();
    }

    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    public function disk()
    {
        return $this->disk = $this->disk ?: BeltHelper::baseDisk();
    }

    /**
     * Write $config array to configuration file
     *
     * @param $path
     * @param $array
     */
    public function writeConfig($path, $array)
    {
        $contents = (new Riimu\Kit\PHPEncoder\PHPEncoder())->encode($array);

        $this->disk()->put($path, "<?php \r\n\r\nreturn " . $contents . ';');
    }

    /**
     * Delete elastic index
     */
    public function deleteIndex()
    {
        try {
            $this->indices()->delete(['index' => $this->index]);
        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }

    /**
     * Delete elastic index
     */
    public function createIndex()
    {

        try {
            $this->indices()->create([
                'index' => $this->index,
                'body' => [
                    'number_of_replicas' => config("belt.elastic.settings.index.number_of_replicas", 1),
                    'refresh_interval' => config("belt.elastic.settings.index.refresh_interval", 0),
                    'analysis' => config("belt.elastic.settings.analysis", []),
                ]
            ]);

            $this->putMappings();

        } catch (\Exception $e) {
            dump($e->getMessage());
        }
    }

    /**
     * Fetch (and write) index settings
     */
    public function getSettings()
    {
        $settings = $this->indices()->getSettings(['index' => $this->index]);

        $this->writeConfig('config/belt/elastic/settings.php', array_get($settings, $this->index . '.settings', []));
    }

    /**
     * Fetch (and write) index mappings
     */
    public function getMappings()
    {
        $mappings = $this->indices()->getMapping(['index' => $this->index]);

        foreach (array_get($mappings, "$this->index.mappings", []) as $key => $mapping) {
            $this->writeConfig("config/belt/elastic/mappings/$key.php", $mapping);
        }
    }

    /**
     * Push index mappings
     *
     * @return mixed
     */
    public function putMappings()
    {
        $mappings = config('belt.elastic.mappings');

        foreach ($mappings as $type => $mapping) {
            $result = $this->indices()->putMapping([
                'index' => $this->index,
                'type' => $type,
                'body' => $mapping
            ]);
            dump($result);
        }
    }

    /**
     * Upset items to elastic index
     *
     * @param $types
     */
    public function import($types)
    {
        $types = is_array($types) ? $types : explode(',', $types);

        foreach ($types as $type) {
            $qb = $this->morphHelper->type2QB($type);
            $this->engine()->update($qb->get());
        }

    }

}