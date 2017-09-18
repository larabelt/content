<?php

namespace Belt\Content\Search\Elastic;

/**
 * Class ElasticHelper
 * @package Belt\Content\Services
 */
class ElasticConfigHelper
{

    public static $analyzers = [
        'case_insensitive_sort' => [
            'filter' => [
                'lowercase'
            ],
            'tokenizer' => 'keyword',
        ],
    ];

    public static $properties = [
        'boolean' => [
            'type' => 'boolean',
        ],
        'datetime' => [
            'type' => 'text',
            'fields' => [
                'keyword' => [
                    'type' => 'keyword',
                    'ignore_above' => 256,
                ],
            ],
        ],
        'name' => [
            'type' => 'text',
            'fields' => [
                'keyword' => [
                    'type' => 'keyword',
                    'ignore_above' => 256,
                ],
                'lower_case_sort' => [
                    'type' => 'string',
                    'analyzer' => 'case_insensitive_sort',
                ],
            ],
            'analyzer' => 'snowball',
        ],
        'primary_key' => [
            'type' => 'long',
        ],
        'string' => [
            'type' => 'text',
            'fields' => [
                'keyword' => [
                    'type' => 'keyword',
                    'ignore_above' => 256,
                ],
            ],
        ],
        'text' => [
            'type' => 'text',
            'fields' => [
                'keyword' => [
                    'type' => 'keyword',
                    'ignore_above' => 256,
                ],
            ],
            'analyzer' => 'snowball',
        ],

    ];

    public static function analyzer($key)
    {
        return static::$analyzers[$key] ?? [];
    }

    public static function property($key)
    {
        return static::$properties[$key] ?? [];
    }

}