<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreHandle
 * @package Belt\Content\Http\Requests
 */
class StoreHandle extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|unique:handles|unique_route',
            'handleable_id' => 'required',
            'handleable_type' => 'required',
        ];
    }

}