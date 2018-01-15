<?php

namespace Belt\Content\Validators;

use Belt\Core\Helpers\UrlHelper;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Concerns\ValidatesAttributes;

/**
 * Class AltUrlValidator
 * @package Belt\Content\Validators
 */
class AltUrlValidator
{
    use ValidatesAttributes;

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param Validator $validator
     * @return bool
     */
    public function altUrl($attribute, $value, $parameters, Validator $validator)
    {
        $validator->setFallbackMessages(
            array_merge($validator->fallbackMessages, [
                'alt_url' => 'The :attribute format is invalid or does not exist.'
            ])
        );

        # absolute urls
        $is_validated = $this->validateUrl($attribute, $value);

        # active relative urls
        if (!$is_validated) {
            $relative_url = url($value);
            //$is_validated = $this->validateUrl($attribute, $relative_url);
            $is_validated = UrlHelper::exists($relative_url);
        }

        return $is_validated;
    }

}