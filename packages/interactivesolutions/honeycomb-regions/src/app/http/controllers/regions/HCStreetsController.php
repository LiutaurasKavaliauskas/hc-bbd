<?php namespace interactivesolutions\honeycombregions\app\http\controllers\regions;

use DB;
use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombregions\app\models\regions\HCStreets;
use interactivesolutions\honeycombregions\app\validators\regions\HCStreetsValidator;

class HCStreetsController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView()
    {
        $config = [
            'title'       => trans('HCRegions::regions_streets.page_title'),
            'listURL'     => route('admin.api.regions.streets'),
            'newFormUrl'  => route('admin.api.form-manager', ['regions-streets-new']),
            'editFormUrl' => route('admin.api.form-manager', ['regions-streets-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if ($this->user()->can('interactivesolutions_honeycomb_regions_regions_streets_create'))
            $config['actions'][] = 'new';

        if ($this->user()->can('interactivesolutions_honeycomb_regions_regions_streets_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user()->can('interactivesolutions_honeycomb_regions_regions_streets_delete'))
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
            'city'         => [
                "type"  => "text",
                "label" => trans('HCRegions::regions_streets.city_id'),
            ],
            'name'            => [
                "type"  => "text",
                "label" => trans('HCRegions::regions_streets.name'),
            ],
            'translation_key' => [
                "type"  => "text",
                "label" => trans('HCRegions::regions_streets.translation_key'),
            ],

        ];
    }

    /**
     * Create item
     *
     * @param array|null $data
     * @return mixed
     */
    protected function __create(array $data = null)
    {
        if (is_null($data))
            $data = $this->getInputData();

        $record = HCStreets::create(array_get($data, 'record'));
        $record->city_parts()->sync(array_get($data, 'city_parts'));

        return $this->getSingleRecord($record->id);
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __update(string $id)
    {
        $data = $this->getInputData();

        $record = HCStreets::findOrFail($id);


        $record->update(array_get($data, 'record'));
        $record->city_parts()->sync(array_get($data, 'city_parts'));

        return $this->getSingleRecord($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __updateStrict(string $id)
    {
        HCStreets::where('id', $id)->update(request()->all());

        return $this->getSingleRecord($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __delete(array $list)
    {
        HCStreets::destroy($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __forceDelete(array $list)
    {
        HCStreets::onlyTrashed()->whereIn('id', $list)->forceDelete();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __restore(array $list)
    {
        HCStreets::whereIn('id', $list)->restore();
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
            $select = HCStreets::getFillableFields();

        $list = HCStreets::with($with)->select($select)
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
    public function list()
    {
        return $this->createQuery()->get();
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

        //TODO set limit to start search

        return $this->list();
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
                $query->where('city_id', 'LIKE', '%' . $parameter . '%')
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
        (new HCStreetsValidator())->validateForm();

        $_data = request()->all();

        array_set($data, 'record.city_id', array_get($_data, 'city_id'));
        array_set($data, 'record.name', array_get($_data, 'name'));
        array_set($data, 'record.translation_key', array_get($_data, 'translation_key'));
        array_set($data, 'city_parts', array_get($_data, 'city_parts'));

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
        $with = ['city_parts'];

        $select = HCStreets::getFillableFields();

        $record = HCStreets::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }
}
