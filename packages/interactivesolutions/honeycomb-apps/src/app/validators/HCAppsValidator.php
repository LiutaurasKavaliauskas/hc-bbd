<?php namespace interactivesolutions\honeycombapps\app\validators;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCAppsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'name' => 'required',

        ];
    }
}