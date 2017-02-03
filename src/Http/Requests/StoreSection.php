<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\FormRequest;

class StoreSection extends FormRequest
{

    public function rules()
    {
        return [
            'page_id' => 'required',
            'parent_id' => 'required',
            'sectionable_id' => 'required',
            'sectionable_type' => 'required',
            'template' => 'required',
        ];
    }

}