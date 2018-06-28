<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreAttachment
 * @package Belt\Content\Http\Requests
 */
class StoreAttachment extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {

        $drivers = array_keys(config('belt.content.drivers')) ?? [];
        $drivers[] = null;

        return [
            'file' => 'required|file',
            'driver' => 'in:' . implode(',', $drivers),
        ];
    }

}