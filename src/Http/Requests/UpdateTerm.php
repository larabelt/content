<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class UpdateTerm
 * @package Belt\Content\Http\Requests
 */
class UpdateTerm extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required',
        ];
    }

}