<?php

namespace interactivesolutions\honeycombregions\app\forms\regions;

use interactivesolutions\honeycomblanguages\app\models\HCLanguages;

class HCCountriesForm
{
    // name of the form
    protected $formID = 'regions-countries';

    // is form multi language
    protected $multiLanguage = 0;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.regions.countries'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"     => "singleLine",
                    "fieldID"  => "common_name",
                    "label"    => trans("HCRegions::regions_countries.common_name"),
                    "readonly" => 1,
                ], [
                    "type"     => "singleLine",
                    "fieldID"  => "official_name",
                    "label"    => trans("HCRegions::regions_countries.official_name"),
                    "readonly" => 1,
                ]
            ],
        ];

        $form['structure'][] = [
            "type"    => "dropDownList",
            "fieldID" => "languages",
            "label"   => trans("HCRegions::regions_countries.languages"),
            "search"  => [],
            "options" => HCLanguages::select('id', 'language')->get()
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = [];

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}