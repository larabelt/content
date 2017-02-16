<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

class UpdateSection extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'sometimes|required',
            'body' => 'sometimes|required',
        ];
    }

}