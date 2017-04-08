<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreFavorite
 * @package Belt\Content\Http\Requests
 */
class StoreFavorite extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'favoriteable_id' => 'required',
            'favoriteable_type' => 'required',
        ];
    }

}