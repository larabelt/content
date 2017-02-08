<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

class AttachCategory extends FormRequest
{

    public function rules()
    {
        return [
            'id' => 'required|exists:categories,id',
        ];
    }

}