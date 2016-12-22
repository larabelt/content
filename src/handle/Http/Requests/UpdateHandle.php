<?php
namespace Ohio\Content\Handle\Http\Requests;

use Ohio\Core\Base\Http\Requests\FormRequest;

class UpdateHandle extends FormRequest
{

    public function rules()
    {
        return [
            'url' => 'sometimes|required',
            'handleable_id' => 'sometimes|required',
            'handleable_type' => 'sometimes|required',
        ];
    }

}