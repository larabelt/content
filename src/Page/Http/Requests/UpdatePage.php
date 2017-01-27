<?php
namespace Ohio\Content\Page\Http\Requests;

use Ohio\Core\Base\Http\Requests\FormRequest;

class UpdatePage extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'sometimes|required',
            'body' => 'sometimes|required',
        ];
    }

}