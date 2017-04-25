<?php

namespace interactivesolutions\honeycombapps\app\forms\apps;

use interactivesolutions\honeycombapps\app\models\HCApps;

class HCAppsTokensForm
{
    // name of the form
    protected $formID = 'apps-tokens';

    // is form multi language
    protected $multiLanguage = 0;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm (bool $edit = false)
    {
        $form = [
            'storageURL' => route ('admin.api.apps.tokens'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans ('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "app_id",
                    "label"           => trans ("HCApps::apps_tokens.app_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCApps::get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes" => ['name']
                    ],
                ],
                [
                    "type"            => "dateTimePicker",
                    "fieldID"         => "expires_at",
                    "label"           => trans ("HCApps::apps_tokens.expires_at"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "properties"      => [
                        "format" => "Y-M-D HH:mm:ss",
                    ],
                ],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = getHCContentLanguages ();

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
         $form['structure'][] = [
             "type"            => "singleLine",
             "fieldID"         => "token",
             "label"           => trans ("HCApps::apps_tokens.token"),
             "readonly"        => 1,
             "note"            => trans("HCApps::apps_tokens.token_note")
         ];

        return $form;
    }
}