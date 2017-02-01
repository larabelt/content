<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

class UpdateTout extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'sometimes|required',
            'body' => 'sometimes|required',
        ];
    }

}