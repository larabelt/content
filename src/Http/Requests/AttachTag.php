<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

class AttachTag extends FormRequest
{


    public function rules()
    {
        return [
            'id' => 'required|exists:tags,id',
        ];
    }

}