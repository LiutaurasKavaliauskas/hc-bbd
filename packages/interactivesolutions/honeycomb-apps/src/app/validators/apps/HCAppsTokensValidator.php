<?php namespace interactivesolutions\honeycombapps\app\validators\apps;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCAppsTokensValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules ()
    {
        return [
            'expires_at' => 'required',
            'app_id'     => 'required',

        ];
    }
}