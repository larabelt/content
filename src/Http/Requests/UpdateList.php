<?php
namespace Belt\Spot\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class UpdateItinerary
 * @package Belt\Spot\Http\Requests
 */
class UpdateItinerary extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required',
            'body' => 'sometimes|required',
        ];
    }

}