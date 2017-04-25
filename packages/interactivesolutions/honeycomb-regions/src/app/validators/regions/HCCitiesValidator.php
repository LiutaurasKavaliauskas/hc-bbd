<?php namespace interactivesolutions\honeycombregions\app\validators\regions;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCCitiesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'municipality_id' => 'required',
'name' => 'required',

        ];
    }
}