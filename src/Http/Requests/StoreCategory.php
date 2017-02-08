<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

class StoreCategory extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}