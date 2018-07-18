<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreListItem
 * @package Belt\Content\Http\Requests
 */
class StoreListItem extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'template' => 'required',
        ];
    }

}