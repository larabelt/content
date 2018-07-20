<?php

namespace Belt\Content\Http\Requests;

use Belt\Content\Handle;
use Belt\Core\Http\Requests\FormRequest;

/**
 * Class HandleFormRequest
 * @package Belt\Content\Http\Requests
 */
class HandleFormRequest extends FormRequest
{

    /**
     * @var array
     */
    protected $configs = [];

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @return mixed
     */
    public function configs()
    {
        return $this->configs ?: $this->configs = config('belt.subtypes.handles', []);
    }

    /**
     * @param null $key
     * @param null $default
     * @return mixed
     */
    public function config($key = null, $default = null)
    {
        $subtype = $this->get('subtype', 'default');

        $config = array_get($this->configs(), $subtype);

        if ($key) {
            return array_get($config, $key, $default);
        }

        return $config;
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'target.unique' => 'target exists as url in other handle',
        ];
    }

    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        $all = parent::all($keys);

        if (array_has($all, 'url')) {
            $all['url'] = Handle::normalizeUrl($all['url']);
        }

        return $all;
    }

}