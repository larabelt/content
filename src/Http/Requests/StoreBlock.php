<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

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