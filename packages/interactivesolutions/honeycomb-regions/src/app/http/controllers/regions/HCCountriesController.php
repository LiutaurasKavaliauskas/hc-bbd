<?php namespace interactivesolutions\honeycombregions\app\http\controllers\regions;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombregions\app\models\regions\HCContinents;
use interactivesolutions\honeycombregions\app\models\regions\HCCountries;
use interactivesolutions\honeycombregions\app\models\regions\HCCountriesLanguagesConnections;
use interactivesolutions\honeycombregions\app\validators\regions\HCCountriesValidator;

class HCCountriesController extends HCBaseController
{

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView ()
    {
        $config = [
            'title'       => trans ('HCRegions::regions_countries.page_title'),
            'listURL'     => route ('admin.api.regions.countries'),
            'newFormUrl'  => route ('admin.api.form-manager', ['regions-countries-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['regions-countries-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if ($this->user ()->can ('interactivesolutions_honeycomb_regions_regions_countries_update'))
            $config['actions'][] = 'update';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters ();

        return view ('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader ()
    {
        return [
            'flag_id'           => [
                "type"    => "image",
                "label"   => trans ('HCRegions::regions_countries.flag_id'),
                "options" => [
                    "w" => 100,
                    "h" => 100,
                ]
            ],
            'common_name'       => [
                "type"  => "text",
                "label" => trans ('HCRegions::regions_countries.common_name'),
            ],
            'official_name'     => [
                "type"  => "text",
                "label" => trans ('HCRegions::regions_countries.official_name'),
            ],
            'translation'       => [
                "type"  => "text",
                "label" => trans ('HCRegions::regions_countries.translation'),
            ],
            'iso_3166_1_alpha2' => [
                "type"  => "text",
                "label" => trans ('HCRegions::regions_countries.iso_3166_1_alpha2'),
            ],
            'iso_3166_1_alpha3' => [
                "type"  => "text",
                "label" => trans ('HCRegions::regions_countries.iso_3166_1_alpha3'),
            ]
        ];
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __update (string $id)
    {
        $record = HCCountries::findOrFail ($id);
        $record->languages ()->sync (array_get ($this->getInputData (), 'languages'));

        return $this->getSingleRecord ($record->id);
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    public function createQuery (array $select = null)
    {
        $with = [];

        if ($select == null)
            $select = HCCountries::getFillableFields ();

        $list = HCCountries::with ($with)->select ($select)
            // add filters
            ->where (function ($query) use ($select) {
                $query = $this->getRequestParameters ($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted ($list);

        // add search items
        $list = $this->listSearch ($list);

        // ordering data
        $list = $this->orderData ($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param $list
     * @return mixed
     */
    protected function listSearch (Builder $list)
    {
        if (request ()->has ('q')) {
            $parameter = request ()->input ('q');

            $list = $list->where (function ($query) use ($parameter) {
                $query->where ('region_id', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('common_name', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('official_name', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('translation_key', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('iso_3166_1_alpha2', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('iso_3166_1_alpha3', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('flag_id', 'LIKE', '%' . $parameter . '%')
                    ->orWhere ('geo_data', 'LIKE', '%' . $parameter . '%');
            });
        }

        return $list;
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData ()
    {
        (new HCCountriesValidator())->validateForm ();

        $_data = request ()->all ();

        array_set ($data, 'languages', array_get ($_data, 'languages'));

        return $data;
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function getSingleRecord (string $id)
    {
        $with = ['languages'];

        $select = HCCountries::getFillableFields ();

        $record = HCCountries::with ($with)
            ->select ($select)
            ->where ('id', $id)
            ->firstOrFail ();

        return $record;
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    private function getFilters ()
    {
        $filters = [];

        $regions = [
            'fieldID'   => 'region_id',
            'type'      => 'dropDownList',
            'label'     => trans ('HCRegions::regions_countries.region'),
            'options'   => HCContinents::all ()->toArray(),
            'showNodes' => ['name'],
        ];

        $filters[] = addAllOptionToDropDownList ($regions);

        return $filters;
    }
}
