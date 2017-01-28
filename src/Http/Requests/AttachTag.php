<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

class AttachTag extends FormRequest
{


    public function rules()
    {
        return [
            'id' => 'required|exists:tags,id',
        ];
    }

}