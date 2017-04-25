<?php

namespace Belt\Content\Http\Requests;

/**
 * Class StoreHandle
 * @package Belt\Content\Http\Requests
 */
class StoreHandle extends HandleFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        $rules = [
            'config_name' => 'sometimes|in:' . implode(',', array_keys($this->configs())),
            'url' => [
                'required',
                'unique_route',
                'unique:handles,url',
                'unique:handles,target',
            ],
            'handleable_id' => $this->config('show_handlable', false) ? 'required' : '',
            'handleable_type' => $this->config('show_handlable', false) ? 'required' : '',
        ];

        if ($this->config('show_target', false)) {
            $rules['target'] = 'required|unique:handles,url';
        }

        return $rules;
    }

}