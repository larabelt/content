<?php
namespace Ohio\Content\Tag\Http\Requests;

use Ohio\Core\Base\Http\Requests\FormRequest;

class AttachTag extends FormRequest
{


    public function rules()
    {
        return [
            'id' => 'required|exists:tags,id',
        ];
    }

}