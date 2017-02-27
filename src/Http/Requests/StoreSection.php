<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreSection
 * @package Belt\Content\Http\Requests
 */
class StoreSection extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'page_id' => 'required',
            'sectionable_type' => 'required',
            'template' => 'required',
        ];
    }

}