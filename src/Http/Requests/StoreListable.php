<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreListable
 * @package Belt\Content\Http\Requests
 */
class StoreListable extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'place_id' => 'required|exists:places,id',
        ];
    }

}