<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

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