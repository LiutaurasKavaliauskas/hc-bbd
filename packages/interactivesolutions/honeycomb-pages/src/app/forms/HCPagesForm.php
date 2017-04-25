<?php

namespace interactivesolutions\honeycombpages\app\forms;

class HCPagesForm
{
    // name of the form
    protected $formID = 'pages';

    // is form multi language
    protected $multiLanguage = 1;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.pages'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [

                //Pages Tab
                [
                    "type"            => "resource",
                    "fieldID"         => "cover_photo_id",
                    "tabID"           => trans("Page"),
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "label"           => trans("HCPages::pages.cover_photo_id"),
                    "fileCount"       => 1,
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-MM-D HH:mm:ss",
                    ],
                    "fieldID"         => "publish_at",
                    "tabID"           => trans("Page"),
                    "label"           => trans("HCPages::pages.publish_at"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-MM-D HH:mm:ss",
                    ],
                    "fieldID"         => "expires_at",
                    "tabID"           => trans("Page"),
                    "label"           => trans("HCPages::pages.expires_at"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                //------------INTRODUCTION PAGE--------------------//
                //Header Tab
                [
                    "type"            => "resource",
                    "fieldID"         => "translations.cover_photo_id",
                    "tabID"           => trans("Header section"),
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "label"           => trans("HCPages::pages.cover_photo_id"),
                    "fileCount"       => 1,
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.title",
                    "tabID"           => trans("Header section"),
                    "label"           => trans("HCPages::pages.title"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.summary",
                    "tabID"           => trans("Header section"),
                    "label"           => trans("HCPages::pages.summary"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ],
                //Intro section
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.intro_section_icon",
                    "tabID"           => trans("Intro section"),
                    "label"           => trans("HCPages::pages.intro_section_icon"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.intro_section_summary",
                    "tabID"           => trans("Intro section"),
                    "label"           => trans("HCPages::pages.intro_section_summary"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,

                ], [
                    "type"            => "richTextArea",
                    "fieldID"         => "translations.intro_section_content",
                    "tabID"           => trans("Intro section"),
                    "label"           => trans("HCPages::pages.intro_section_content"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ],
                //About section
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.about_section_title",
                    "tabID"           => trans("About section"),
                    "label"           => trans("HCPages::pages.about_section_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,

                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.about_section_summary",
                    "tabID"           => trans("About section"),
                    "label"           => trans("HCPages::pages.about_section_summary"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,

                ], [
                    "type"         => "checkBoxList",
                    "fieldID"      => "translations.about_section_is_button",
                    "tabID"        => trans("About section"),
                    "label"        => trans("HCPages::pages.about_section_is_button"),
                    "options"      => [
                        [
                            "id"    => 1,
                            "label" => trans("HCPages::pages.is_button"),
                        ],
                    ],
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.about_section_button_href",
                    "tabID"           => trans("About section"),
                    "label"           => trans("HCPages::pages.about_section_button_href"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                    "dependencies"    => [
                        [
                            "field_id"    => "translations.about_section_is_button",
                            "field_value" => 1,
                        ],
                    ]
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.about_section_button_text",
                    "tabID"           => trans("About section"),
                    "label"           => trans("HCPages::pages.about_section_button_text"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                    "dependencies"    => [
                        [
                            "field_id"    => "translations.about_section_is_button",
                            "field_value" => 1,
                        ],
                    ]
                ],
                //Contact section
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.contact_section_title",
                    "tabID"           => trans("Contact section"),
                    "label"           => trans("HCPages::pages.contact_section_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.contact_section_number",
                    "tabID"           => trans("Contact section"),
                    "label"           => trans("HCPages::pages.contact_section_number"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.contact_section_email",
                    "tabID"           => trans("Contact section"),
                    "label"           => trans("HCPages::pages.contact_section_email"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ],


                //------------INTRODUCTION PAGE--------------------//
                //
                [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-MM-D HH:mm:ss",
                    ],
                    "fieldID"         => "translations.publish_at",
                    "tabID"           => trans("Header section"),
                    "label"           => trans("HCPages::pages.publish_at"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "dateTimePicker",
                    "properties"      => [
                        "format" => "Y-MM-D HH:mm:ss",
                    ],
                    "fieldID"         => "translations.expires_at",
                    "tabID"           => trans("Header section"),
                    "label"           => trans("HCPages::pages.expires_at"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = getHCContentLanguages();


        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        $form['structure'][] = [
            "type"          => "singleLine",
            "fieldID"       => "translations.slug",
            "tabID"         => trans("Header section"),
            "label"         => trans("HCPages::pages.slug"),
            "readonly"      => 1,
            "multiLanguage" => 1,
        ];

        return $form;
    }
}