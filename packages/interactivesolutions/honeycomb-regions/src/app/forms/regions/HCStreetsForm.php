<?php

namespace interactivesolutions\honeycombregions\app\forms\regions;

use interactivesolutions\honeycombregions\app\models\regions\HCCountries;

class HCStreetsForm
{
    // name of the form
    protected $formID = 'regions-streets';

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
            'storageURL' => route('admin.api.regions.streets'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "country_id",
                    "label"           => trans("HCRegions::regions_municipalities.country_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCCountries::select('id', 'translation_key')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translation"]
                    ]
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "municipality_id",
                    "label"           => trans("HCRegions::regions.municipality"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translation"]
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "country_id",
                            "options_url" => route('admin.api.regions.municipalities.list'),
                        ],
                    ],
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "city_id",
                    "label"           => trans("HCRegions::regions.cities"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["name"]
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "municipality_id",
                            "options_url" => route('admin.api.regions.cities.list'),
                        ],
                    ],
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "city_parts",
                    "label"           => trans("HCRegions::regions.parts"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "search"          => [
                        "showNodes" => ["name"]
                    ],
                    "dependencies"    => [
                        [
                            "field_id"    => "city_id",
                            "options_url" => route('admin.api.regions.parts.list'),
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "name",
                    "label"           => trans("HCRegions::regions_streets.name"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "dependencies"    => [
                        [
                            "field_id" => "country_id",
                        ],
                        [
                            "field_id" => "municipality_id",
                        ],
                        [
                            "field_id" => "city_id",
                        ],
                    ],
                ],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = []; //TOTO implement honeycomb-languages package

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}