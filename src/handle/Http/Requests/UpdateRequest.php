<?php
namespace Ohio\Content\Handle\Http\Requests;

use Ohio\Core\Base\Http\Requests\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'url' => 'sometimes|required',
        ];
    }

}