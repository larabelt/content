<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

class UpdateTag extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'sometimes|required',
        ];
    }

}