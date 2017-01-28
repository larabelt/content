<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

class StoreTag extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}