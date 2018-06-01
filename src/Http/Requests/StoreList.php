<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreList
 * @package Belt\Content\Http\Requests
 */
class StoreList extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        if ($this->get('source')) {
            return [
                'source' => 'exists:lists,id',
            ];
        }

        return [
            'name' => 'required|unique:lists,name',
        ];
    }

}