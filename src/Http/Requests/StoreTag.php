<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

class StoreTag extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}