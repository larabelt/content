<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreTerm
 * @package Belt\Content\Http\Requests
 */
class StoreTerm extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

}