<?php
namespace Ohio\Content\Page\Http\Requests;

use Ohio\Core\Base\Http\Requests\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
        ];
    }

}