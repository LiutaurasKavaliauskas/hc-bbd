<?php

namespace interactivesolutions\honeycombpages\app\models;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCPagesTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_pages_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'record_id', 'language_code', 'title', 'slug', 'summary', 'intro_section_icon', 'intro_section_summary', 'intro_section_content', 'about_section_title', 'about_section_summary', 'about_section_is_button', 'about_section_button_href', 'about_section_button_text', 'contact_section_title', 'contact_section_number', 'contact_section_email', 'cover_photo_id', 'author_id', 'publish_at', 'expires_at'];
}