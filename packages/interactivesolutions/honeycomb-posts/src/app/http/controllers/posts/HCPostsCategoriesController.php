<?php namespace interactivesolutions\honeycombposts\app\http\controllers\posts;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombposts\app\models\posts\HCPostsCategories;
use interactivesolutions\honeycombposts\app\validators\posts\HCPostsCategoriesValidator;
use interactivesolutions\honeycombposts\app\validators\posts\HCPostsCategoriesTranslationsValidator;

class HCPostsCategoriesController extends HCBaseController
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
            'title'       => trans('HCPosts::posts_categories.page_title'),
            'listURL'     => route('admin.api.posts.categories'),
            'newFormUrl'  => route('admin.api.form-manager', ['posts-categories-new']),
            'editFormUrl' => route('admin.api.form-manager', ['posts-categories-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if ($this->user()->can('interactivesolutions_honeycomb_posts_posts_categories_create'))
            $config['actions'][] = 'new';

        if ($this->user()->can('interactivesolutions_honeycomb_posts_posts_categories_update'))
        {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user()->can('interactivesolutions_honeycomb_posts_posts_categories_delete'))
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters ();

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
            'parent_id'     => [
    "type"  => "text",
    "label" => trans('HCPosts::posts_categories.parent_id'),
],
'cover_photo_id'     => [
    "type"  => "text",
    "label" => trans('HCPosts::posts_categories.cover_photo_id'),
],
'translations.{lang}.title'     => [
    "type"  => "text",
    "label" => trans('HCPosts::posts_categories.title'),
],
'translations.{lang}.slug'     => [
    "type"  => "text",
    "label" => trans('HCPosts::posts_categories.slug'),
],
'translations.{lang}.content'     => [
    "type"  => "text",
    "label" => trans('HCPosts::posts_categories.content'),
],
'translations.{lang}.cover_photo_id'     => [
    "type"  => "text",
    "label" => trans('HCPosts::posts_categories.cover_photo_id'),
],

        ];
    }

    /**
    * Create item
    *
    * @return mixed
    */
    protected function __create()
    {
        $data = $this->getInputData();

        $record = HCPostsCategories::create(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));

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
        $record = HCPostsCategories::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));

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
        HCPostsCategories::where('id', $id)->update(request()->all());

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
        HCPostsCategories::destroy($list);
    }

    /**
    * Delete records table
    *
    * @param $list
    * @return mixed|void
    */
    protected function __forceDelete(array $list)
    {
        HCPostsCategories::onlyTrashed()->whereIn('id', $list)->forceDelete();
    }

    /**
    * Restore multiple records
    *
    * @param $list
    * @return mixed|void
    */
    protected function __restore(array $list)
    {
        HCPostsCategories::whereIn('id', $list)->restore();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    public function createQuery(array $select = null)
    {
        $with = ['translations'];

        if ($select == null)
            $select = HCPostsCategories::getFillableFields();

        $list = HCPostsCategories::with($with)->select($select)
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
         if(request()->has('q'))
         {
             $parameter = request()->input('q');

             $list = $list->where(function ($query) use ($parameter)
             {
                $query->where('parent_id', 'LIKE', '%' . $parameter . '%')
->orWhere('cover_photo_id', 'LIKE', '%' . $parameter . '%')
;
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
        (new HCPostsCategoriesValidator())->validateForm();
        (new HCPostsCategoriesTranslationsValidator())->validateForm();

        $_data = request()->all();

        array_set($data, 'record.parent_id', array_get($_data, 'parent_id'));
array_set($data, 'record.cover_photo_id', array_get($_data, 'cover_photo_id'));

        $translations = array_get($_data, 'translations');

    //    foreach ($translations as &$value)
    //    {
    //        if (!isset($value['slug']) || $value['slug'] == "")
    //            $value['slug'] = generateHCSlug(DEFINE FROM WHICH PARAMETERS);
    //    }

        array_set($data, 'translations', $translations);

        return makeEmptyNullable($data);
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function getSingleRecord(string $id)
    {
        $with = ['translations'];

        $select = HCPostsCategories::getFillableFields();

        $record = HCPostsCategories::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        return $filters;
    }
}
