<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

class StoreTout extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|unique:touts,name',
            'body' => 'required',
        ];
    }

}