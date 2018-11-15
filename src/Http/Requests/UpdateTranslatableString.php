<?php
namespace Belt\Content\Http\Requests;

use Belt;

/**
 * Class UpdateTranslatableString
 * @package Belt\Core\Http\Requests
 */
class UpdateTranslatableString extends Belt\Core\Http\Requests\FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'sometimes|required',
        ];
    }

}