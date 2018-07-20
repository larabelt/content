<?php

namespace Belt\Content\Http\Requests;

use Illuminate\Validation\Rule;

/**
 * Class UpdateHandle
 * @package Belt\Content\Http\Requests
 */
class UpdateHandle extends HandleFormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        $handle = $this->route('handle');

        $rules = [
            'subtype' => 'sometimes|in:' . implode(',', array_keys($this->configs())),
            'url' => [
                'sometimes',
                'unique_route',
                Rule::unique('handles', 'url')->ignore($handle->id),
            ],
            'handleable_id' => $this->config('show_handlable', false) ? 'sometimes' : '',
            'handleable_type' => $this->config('show_handlable', false) ? 'sometimes' : '',
        ];

        if ($this->config('show_target', false)) {
            $rules['target'] = 'required';
        }

        return $rules;
    }

}