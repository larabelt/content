<?php
namespace Ohio\Content\Page\Http\Requests;

use Ohio\Core\Base\Http\Requests\FormRequest;

class StorePage extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'body' => 'required',
        ];
    }

}