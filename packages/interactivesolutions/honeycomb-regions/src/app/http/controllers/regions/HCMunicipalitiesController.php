<?php namespace interactivesolutions\honeycombregions\app\http\controllers\regions;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombregions\app\models\regions\HCMunicipalities;
use interactivesolutions\honeycombregions\app\validators\regions\HCMunicipalitiesValidator;

class HCMunicipalitiesController extends HCBaseController
{

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        $config = [
            'title'       => trans('HCRegions::regions_municipalities.page_title'),
            'listURL'     => route('admin.api.regions.municipalities'),
            'newFormUrl'  => route('admin.api.form-manager', ['regions-municipalities-new']),
            'editFormUrl' => route('admin.api.form-manager', ['regions-municipalities-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if ($this->user()->can('interactivesolutions_honeycomb_regions_regions_municipalities_create'))
            $config['actions'][] = 'new';

        if ($this->user()->can('interactivesolutions_honeycomb_regions_regions_municipalities_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user()->can('interactivesolutions_honeycomb_regions_regions_municipalities_delete'))
            $config['actions'][] = 'delete';

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
            'country_id'      => [
                "type"  => "text",
                "label" => trans('HCRegions::regions_municipalities.country_id'),
            ],
            'name'            => [
                "type"  => "text",
                "label" => trans('HCRegions::regions_municipalities.name'),
            ],
            'translation' => [
                "type"  => "text",
                "label" => trans('HCRegions::regions_municipalities.translation'),
            ],

        ];
    }

    /**
     * Creating data query
     *
     * @return $this|mixed
     */
    public function createQuery()
    {
        $with = [];
        $select = HCMunicipalities::getFillableFields();

        $list = HCMunicipalities::with($with)->select($select)
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
     * Creating data list
     * @return mixed
     */
    public function pageData()
    {
        return $this->createQuery()->paginate($this->recordsPerPage);
    }

    /**
     * Creating data list based on search
     * @return mixed
     */
    public function search()
    {
        if (!request('q'))
            return [];

        return $this->createQuery()->get();
    }

    /**
     * Creating data list
     * @return mixed
     */
    public function list()
    {
        return $this->createQuery()->get();
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
                $query->where('country_id', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('name', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('translation_key', 'LIKE', '%' . $parameter . '%');
            });
        }

        return $list;
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCMunicipalitiesValidator())->validateForm();

        $_data = request()->all();

        array_set($data, 'record.country_id', array_get($_data, 'country_id'));
        array_set($data, 'record.name', array_get($_data, 'name'));
        array_set($data, 'record.translation_key', array_get($_data, 'translation_key'));

        return $data;
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

        $select = HCMunicipalities::getFillableFields();

        $record = HCMunicipalities::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }
}
