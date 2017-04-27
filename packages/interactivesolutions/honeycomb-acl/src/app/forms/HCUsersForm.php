<?php

namespace interactivesolutions\honeycombacl\app\forms;

use interactivesolutions\honeycombacl\app\models\acl\Roles;
use interactivesolutions\honeycombacl\app\models\acl\RolesUsersConnections;

class HCUsersForm
{
    // name of the form
    protected $formID = 'users';

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
            'storageURL' => route('admin.api.users'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCCoreUI::core.button.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "singleLine",
                    "fieldID"         => "email",
                    "label"           => trans("HCACL::users.email"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "password",
                    "fieldID"         => "password",
                    "label"           => trans("HCACL::users.password"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "dropDownList",
                    "fieldID"         => "role_id",
                    "label"           => trans("HCACL::acl_roles.name"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "url"                    => route('admin.api.acl.roles.list'),
                        "showNodes"              => ["name"]
                    ],
                ], [
                    "type"    => "checkBoxList",
                    "fieldID" => "active",
                    "label"   => trans("HCACL::users.active"),
                    "options" => [
                        [
                            "id"    => 1,
                            "label" => ""
                        ]
                    ],
                ],
                //TODO create active field for user
//                formManagerYesNo('active', trans("HCACL::users.active"))
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = []; //TOTO implement honeycomb-languages package

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        $form['structure'] = array_merge($form['structure'],

            [[
                "type"            => "singleLine",
                "fieldID"         => "activated_at",
                "label"           => trans("HCACL::users.activated_at"),
                "required"        => 0,
                "requiredVisible" => 0,
                "readonly"        => 1,
            ], [
                "type"            => "singleLine",
                "fieldID"         => "remember_token",
                "label"           => trans("HCACL::users.remember_token"),
                "required"        => 0,
                "requiredVisible" => 0,
                "readonly"        => 1,
            ], [
                "type"            => "singleLine",
                "fieldID"         => "last_login",
                "label"           => trans("HCACL::users.last_login"),
                "required"        => 0,
                "requiredVisible" => 0,
                "readonly"        => 1,
            ], [
                "type"            => "singleLine",
                "fieldID"         => "last_visited",
                "label"           => trans("HCACL::users.last_visited"),
                "required"        => 0,
                "requiredVisible" => 0,
                "readonly"        => 1,
            ], [
                "type"            => "singleLine",
                "fieldID"         => "last_activity",
                "label"           => trans("HCACL::users.last_activity"),
                "required"        => 0,
                "requiredVisible" => 0,
                "readonly"        => 1,
            ]]);

        return $form;
    }
}