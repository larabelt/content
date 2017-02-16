<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

class StoreHandle extends FormRequest
{

    public function rules()
    {
        return [
            'url' => 'required|unique:handles|unique_route',
            'handleable_id' => 'required',
            'handleable_type' => 'required',
        ];
    }

}