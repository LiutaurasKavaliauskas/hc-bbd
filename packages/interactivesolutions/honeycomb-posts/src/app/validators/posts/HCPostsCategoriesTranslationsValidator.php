<?php namespace interactivesolutions\honeycombposts\app\validators\posts;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCPostsCategoriesTranslationsValidator extends HCCoreFormValidator
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
'translations.*.title' => 'required',
'translations.*.slug' => 'required',

        ];
    }
}