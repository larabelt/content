<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

class StorePage extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}