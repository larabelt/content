<?php
namespace Ohio\Content\Tag\Http\Requests;

use Ohio\Core\Base\Http\Requests\FormRequest;

class UpdateTag extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'sometimes|required',
        ];
    }

}