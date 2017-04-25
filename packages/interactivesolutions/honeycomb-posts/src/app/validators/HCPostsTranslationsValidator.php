<?php namespace interactivesolutions\honeycombposts\app\validators;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCPostsTranslationsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'translations.*.language_code' => 'required',
            'translations.*.title'         => 'required',
        ];
    }
}