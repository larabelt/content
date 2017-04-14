<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class UpdatePost
 * @package Belt\Content\Http\Requests
 */
class UpdatePost extends FormRequest
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