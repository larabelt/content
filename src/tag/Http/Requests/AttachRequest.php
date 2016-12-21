<?php
namespace Ohio\Content\Tag\Http\Requests;

use Ohio\Core\Base\Http\Requests\BaseFormRequest;

class AttachRequest extends BaseFormRequest
{


    public function rules()
    {
        return [
            'id' => 'required|exists:tags,id',
        ];
    }

}