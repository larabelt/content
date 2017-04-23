<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StorePost
 * @package Belt\Content\Http\Requests
 */
class StorePost extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'source_url' => $this->get('source_url') ? 'url' : '',
        ];
    }

}