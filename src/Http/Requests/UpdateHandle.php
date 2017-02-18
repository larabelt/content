<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class UpdateHandle
 * @package Belt\Content\Http\Requests
 */
class UpdateHandle extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'sometimes|required',
            'handleable_id' => 'sometimes|required',
            'handleable_type' => 'sometimes|required',
        ];
    }

}