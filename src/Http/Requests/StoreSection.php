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
            'owner_id' => 'required',
            'owner_type' => 'required',
            //'sectionable_type' => 'required',
            'template' => 'required',
        ];
    }

}