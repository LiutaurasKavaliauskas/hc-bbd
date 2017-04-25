<?php namespace interactivesolutions\honeycomblanguages\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;
use interactivesolutions\honeycombcore\errors\facades\HCLog;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycomblanguages\app\models\HCLanguages;

class HCLanguagesController extends HCBaseController
{

    /**
     * List of available keys for strict update
     *
     * @var array
     */
    protected $strictUpdateKeys = ['content', 'front_end', 'back_end'];

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        $config = [
            'title'       => trans('HCLanguages::languages.page_title'),
            'listURL'     => route('admin.api.languages'),
            'newFormUrl'  => route('admin.api.form-manager', ['languages-new']),
            'editFormUrl' => route('admin.api.form-manager', ['languages-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if ($this->user()->can('interactivesolutions_honeycomb_languages_languages_update')) {
            $config['actions'][] = 'update';
        }

        $config['actions'][] = 'search';

        return view('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'language_family' => [
                "type"  => "text",
                "label" => trans('HCLanguages::languages.language_family'),
            ],
            'language'        => [
                "type"  => "text",
                "label" => trans('HCLanguages::languages.language'),
            ],
            'native_name'     => [
                "type"  => "text",
                "label" => trans('HCLanguages::languages.native_name'),
            ],
            'iso_639_1'       => [
                "type"  => "text",
                "label" => trans('HCLanguages::languages.iso_639_1'),
            ],
            'iso_639_2'       => [
                "type"  => "text",
                "label" => trans('HCLanguages::languages.iso_639_2'),
            ],
            'front_end'       => [
                "type"  => "checkbox",
                "label" => trans('HCLanguages::languages.front_end'),
                "url"   => route('admin.api.languages.update.strict', 'id')
            ],
            'back_end'        => [
                "type"  => "checkbox",
                "label" => trans('HCLanguages::languages.back_end'),
                "url"   => route('admin.api.languages.update.strict', 'id')
            ],
            'content'         => [
                "type"  => "checkbox",
                "label" => trans('HCLanguages::languages.content'),
                "url"   => route('admin.api.languages.update.strict', 'id')
            ],

        ];
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __updateStrict(string $id)
    {
        HCLanguages::where('id', $id)->update($this->getStrictRequestParameters());

        return $this->getSingleRecord($id);
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    public function createQuery(array $select = null)
    {
        $with = [];

        if ($select == null)
            $select = HCLanguages::getFillableFields();

        $list = HCLanguages::with($with)->select($select)
            // add filters
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->listSearch($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }



    /**
     * List search elements
     * @param $list
     * @return mixed
     */
    protected function listSearch(Builder $list)
    {
        if (request()->has('q')) {
            $parameter = request()->input('q');

            $list = $list->where(function ($query) use ($parameter) {
                $query->where('language_family', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('language', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('native_name', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('iso_639_1', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('iso_639_2', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('front_end', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('back_end', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('content', 'LIKE', '%' . $parameter . '%');
            });
        }

        return $list;
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */

    public function getSingleRecord(string $id)
    {
        $with = [];

        $select = HCLanguages::getFillableFields();

        $record = HCLanguages::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    public function changeLanguage (string $location, string $lang)
    {
        switch ($location)
        {
            case 'front-end' :

                if (in_array($lang, getHCFrontEndLanguages()))
                {
                    session('front-end', $lang);
                    session('content', $lang);
                }
                else
                    return HCLog::error('L-001', trans('HCTranslations::core.language_not_found'));

                break;

            case 'back-end' :

                if (in_array($lang, getHCBackEndLanguages()))
                    Session::set('back-end', $lang);
                else
                    return HCLog::error('L-002', trans('HCTranslations::core.language_not_found'));

                break;

            case 'content' :

                if (in_array($lang, getHCContentLanguages()))
                    Session::set('content', $lang);
                else
                    return HCLog::error('L-003', trans('HCTranslations::core.language_not_found'));

                break;
        }
    }
}
