<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class AttachAttachment
 * @package Belt\Content\Http\Requests
 */
class AttachAttachment extends FormRequest
{


    /**
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:attachments,id',
        ];
    }

}