<?php
namespace Belt\Spot\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreListable
 * @package Belt\Spot\Http\Requests
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