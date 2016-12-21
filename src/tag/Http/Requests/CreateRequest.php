<?php
namespace Ohio\Content\Tag\Http\Requests;

use Ohio\Core\Base\Http\Requests\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}