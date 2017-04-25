<?php namespace interactivesolutions\honeycombregions\app\http\controllers\regions;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombregions\app\models\regions\HCContinents;
use interactivesolutions\honeycombregions\app\validators\regions\HCContinentsValidator;

class HCContinentsController extends HCBaseController
{

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        $config = [
            'title'       => trans('HCRegions::regions_continents.page_title'),
            'listURL'     => route('admin.api.regions.continents'),
            'newFormUrl'  => route('admin.api.form-manager', ['regions-continents-new']),
            'editFormUrl' => route('admin.api.form-manager', ['regions-continents-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
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
            'name' => [
                "type"  => "text",
                "label" => trans('HCRegions::regions_continents.name'),
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function createQuery()
    {
        $with = [];
        $select = HCContinents::getFillableFields();

        $list = HCContinents::with($with)->select($select)
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
                $query->where('translation_key', 'LIKE', '%' . $parameter . '%');
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

        $select = HCContinents::getFillableFields();

        $record = HCContinents::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }
}
