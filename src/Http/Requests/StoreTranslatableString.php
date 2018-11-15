<?php
namespace Belt\Content\Http\Requests;

use Belt;

/**
 * Class StoreTranslatableString
 * @package Belt\Core\Http\Requests
 */
class StoreTranslatableString extends Belt\Core\Http\Requests\FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|unique:translatable_strings,value',
        ];
    }

}