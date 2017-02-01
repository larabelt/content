<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

class StoreSection extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required|unique:sections,name',
            'body' => 'required',
        ];
    }

}