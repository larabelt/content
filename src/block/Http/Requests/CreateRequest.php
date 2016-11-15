<?php
namespace Ohio\Content\Block\Http\Requests;

use Ohio\Core\Base\Http\Requests\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'body' => 'required',
        ];
    }

}