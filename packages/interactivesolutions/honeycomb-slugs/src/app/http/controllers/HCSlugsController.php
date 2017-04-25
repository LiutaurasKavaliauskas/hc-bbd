<?php namespace interactivesolutions\honeycombslugs\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombslugs\app\models\HCSlugs;

class HCSlugsController extends HCBaseController
{

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        $config = [
            'title'       => trans('HCSlugs::slugs.page_title'),
            'listURL'     => route('admin.api.slugs'),
            'newFormUrl'  => route('admin.api.form-manager', ['slugs-new']),
            'editFormUrl' => route('admin.api.form-manager', ['slugs-edit']),
            //    'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

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
            'path'       => [
                "type"  => "text",
                "label" => trans('HCSlugs::slugs.path'),
            ],
            'slug'       => [
                "type"  => "text",
                "label" => trans('HCSlugs::slugs.slug'),
            ],
            'slug_count' => [
                "type"  => "text",
                "label" => trans('HCSlugs::slugs.slug_count'),
            ],

        ];
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
            $select = HCSlugs::getFillableFields();

        $list = HCSlugs::with($with)->select($select)
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
                $query->where('path', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('slug', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('slug_count', 'LIKE', '%' . $parameter . '%');
            });
        }

        return $list;
    }
}
