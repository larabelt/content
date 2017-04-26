<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreTout
 * @package Belt\Content\Http\Requests
 */
class StoreTout extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:touts,name',
        ];
    }

}