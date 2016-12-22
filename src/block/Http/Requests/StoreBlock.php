<?php
namespace Ohio\Content\Block\Http\Requests;

use Ohio\Core\Base\Http\Requests\FormRequest;

class StoreBlock extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'body' => 'required',
        ];
    }

}