<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class AttachTerm
 * @package Belt\Content\Http\Requests
 */
class AttachTerm extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:terms,id',
        ];
    }

}