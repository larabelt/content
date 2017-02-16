<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

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