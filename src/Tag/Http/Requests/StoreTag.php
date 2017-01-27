<?php
namespace Ohio\Content\Tag\Http\Requests;

use Ohio\Core\Base\Http\Requests\FormRequest;

class StoreTag extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}