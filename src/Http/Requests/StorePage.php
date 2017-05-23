<?php

namespace Belt\Content\Http\Requests;

use Illuminate\Validation\Rule;
use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StorePage
 * @package Belt\Content\Http\Requests
 */
class StorePage extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        if ($this->get('source')) {
            return [
                'source' => 'exists:pages,id',
            ];
        }

        return [
            'name' => 'required',
        ];
    }

}