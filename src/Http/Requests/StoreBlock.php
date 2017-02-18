<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreBlock
 * @package Belt\Content\Http\Requests
 */
class StoreBlock extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:blocks,name',
            'body' => 'required',
        ];
    }

}