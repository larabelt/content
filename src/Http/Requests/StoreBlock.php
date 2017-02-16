<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

class StoreBlock extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|unique:blocks,name',
            'body' => 'required',
        ];
    }

}