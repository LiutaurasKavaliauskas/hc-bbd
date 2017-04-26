<?php namespace interactivesolutions\honeycombapps\app\http\controllers\apps;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;
use interactivesolutions\honeycombapps\app\models\apps\HCAppsTokens;
use interactivesolutions\honeycombapps\app\validators\apps\HCAppsTokensValidator;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;

class HCAppsTokensController extends HCBaseController
{

    //TODO recordsPerPage setting

    public function bandymas()
    {
        return Redirect::to('/api/v1/apps')->header('Hc-Token', 'aaa');
    }
    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView ()
    {
        $config = [
            'title'       => trans ('HCApps::apps_tokens.page_title'),
            'listURL'     => route ('admin.api.apps.tokens'),
            'newFormUrl'  => route ('admin.api.form-manager', ['apps-tokens-new']),
            'editFormUrl' => route ('admin.api.form-manager', ['apps-tokens-edit']),
            'imagesUrl'   => route ('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader (),
        ];

        if ($this->user ()->can ('interactivesolutions_honeycomb_apps_apps_tokens_create'))
            $config['actions'][] = 'new';

        if ($this->user ()->can ('interactivesolutions_honeycomb_apps_apps_tokens_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user ()->can ('interactivesolutions_honeycomb_apps_apps_tokens_delete'))
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters']   = $this->getFilters ();

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
            'expires_at' => [
                "type"  => "text",
                "label" => trans ('HCApps::apps_tokens.expires_at'),
            ],
            'app_id'     => [
                "type"  => "text",
                "label" => trans ('HCApps::apps_tokens.app_id'),
            ],

        ];
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters ()
    {
        $filters = [];

        return $filters;
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
            $select = HCAppsTokens::getFillableFields ();

        $list = HCAppsTokens::with ($with)->select ($select)
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
                $query->where ('expires_at', 'LIKE', '%' . $parameter . '%')
                      ->orWhere ('token', 'LIKE', '%' . $parameter . '%')
                      ->orWhere ('app_id', 'LIKE', '%' . $parameter . '%');
            });
        }

        return $list;
    }

    /**
     * Create item
     *
     * @return mixed
     */
    protected function __create ()
    {
        $data = $this->getInputData ();

        $record = HCAppsTokens::create (array_get ($data, 'record'));

        return $this->getSingleRecord ($record->id);
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData ()
    {
        (new HCAppsTokensValidator())->validateForm ();

        $_data = request ()->all ();

        $token = array_get ($_data, 'token');

        if (strlen($token) != 255)
            $token = random_str(255);

        array_set ($data, 'record.expires_at', array_get ($_data, 'expires_at'));
        array_set ($data, 'record.token', $token);
        array_set ($data, 'record.app_id', array_get ($_data, 'app_id'));

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
        $with = [];

        $select = HCAppsTokens::getFillableFields ();

        $record = HCAppsTokens::with ($with)
                              ->select ($select)
                              ->where ('id', $id)
                              ->firstOrFail ();

        return $record;
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __update (string $id)
    {
        $record = HCAppsTokens::findOrFail ($id);

        $data = $this->getInputData ();

        $record->update (array_get ($data, 'record'));

        return $this->getSingleRecord ($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __updateStrict (string $id)
    {
        HCAppsTokens::where ('id', $id)->update (request ()->all ());

        return $this->getSingleRecord ($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __delete (array $list)
    {
        HCAppsTokens::destroy ($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __forceDelete (array $list)
    {
        HCAppsTokens::onlyTrashed ()->whereIn ('id', $list)->forceDelete ();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __restore (array $list)
    {
        HCAppsTokens::whereIn ('id', $list)->restore ();
    }
}
