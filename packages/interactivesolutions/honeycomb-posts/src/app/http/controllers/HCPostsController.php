<?php namespace interactivesolutions\honeycombposts\app\http\controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombposts\app\models\HCPosts;
use interactivesolutions\honeycombposts\app\models\HCPostsTranslations;
use interactivesolutions\honeycombposts\app\validators\HCPostsValidator;
use interactivesolutions\honeycombposts\app\validators\HCPostsTranslationsValidator;

class HCPostsController extends HCBaseController
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
            'title'       => trans('HCPosts::posts.page_title'),
            'listURL'     => route('admin.api.posts'),
            'newFormUrl'  => route('admin.api.form-manager', ['posts-new']),
            'editFormUrl' => route('admin.api.form-manager', ['posts-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if ($this->user()->can('interactivesolutions_honeycomb_posts_posts_create'))
            $config['actions'][] = 'new';

        if ($this->user()->can('interactivesolutions_honeycomb_posts_posts_update')) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if ($this->user()->can('interactivesolutions_honeycomb_posts_posts_delete'))
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters();

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
            'author_id'                          => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.author_id'),
            ],
            'publish_at'                         => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.publish_at'),
            ],
            'expires_at'                         => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.expires_at'),
            ],
            'cover_photo_id'                     => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.cover_photo_id'),
            ],
            'translations.{lang}.title'          => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.title'),
            ],
            'translations.{lang}.slug'           => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.slug'),
            ],
            'translations.{lang}.summary'        => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.summary'),
            ],
            'translations.{lang}.content'        => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.content'),
            ],
            'translations.{lang}.cover_photo_id' => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.cover_photo_id'),
            ],
            'translations.{lang}.author_id'      => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.author_id'),
            ],
            'translations.{lang}.publish_at'     => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.publish_at'),
            ],
            'translations.{lang}.expires_at'     => [
                "type"  => "text",
                "label" => trans('HCPosts::posts.expires_at'),
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

        if($data['record']['type'] && $data['record']['type'] == 'blog')
            HCPosts::where('type', 'blog')->delete();

        $record = HCPosts::create(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));

        $this->generatePost($data);
        $this->generateBlog($data);

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
        $record = HCPosts::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));

        $this->generatePost($data);
        $this->generateBlog($data);

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
        HCPosts::where('id', $id)->update(request()->all());

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
        HCPosts::destroy($list);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed|void
     */
    protected function __forceDelete(array $list)
    {
        HCPosts::onlyTrashed()->whereIn('id', $list)->forceDelete();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed|void
     */
    protected function __restore(array $list)
    {
        HCPosts::whereIn('id', $list)->restore();
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
            $select = HCPosts::getFillableFields();

        $list = HCPosts::with($with)->select($select)
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
                $query->where('author_id', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('publish_at', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('expires_at', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('cover_photo_id', 'LIKE', '%' . $parameter . '%');
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
        (new HCPostsValidator())->validateForm();
        (new HCPostsTranslationsValidator())->validateForm();

        $_data = request()->all();

        array_set($data, 'record.author_id', Auth::user()->id);
        array_set($data, 'record.publish_at', array_get($_data, 'publish_at'));
        array_set($data, 'record.expires_at', array_get($_data, 'expires_at'));
        array_set($data, 'record.cover_photo_id', array_get($_data, 'cover_photo_id'));
        array_set($data, 'record.type', array_get($_data, 'type'));

        $translations = array_get($_data, 'translations');

            foreach ($translations as &$value)
            {
                if (!isset($value['slug']) || $value['slug'] == "")
                    $value['slug'] = generateHCSlug(HCPostsTranslations::getTableName() . '_' . $value['language_code'], $value['title']);
            }

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

        $select = HCPosts::getFillableFields();

        $record = HCPosts::with($with)
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

    /**
     * Generating post
     *
     * @param array $data
     */
    public function generatePost(array $data)
    {
        if(!file_exists(public_path('assets/posts')))
            $this->createWebsiteFrame();

        foreach ($data['translations'] as $value)
        {
            if(!isset($value['summary']))
                $value['summary'] = '';

            if(!isset($value['content']))
                $value['content'] = '';

            if(!isset($value['cover_photo_id']))
                $value['cover_photo_id']= 'dereva.jpg';

            $this->createFileFromTemplate([
                "destination"         => __DIR__ . '/../../../resources/views/post/' . $value['slug'] . '.blade.php',
                "templateDestination" => __DIR__ . '/../../commands/templates/post.html.hctpl',
                "content" => [
                    "title" => $value['title'],
                    "summary" => $value['summary'],
                    "content" => $value['content'],
                    "cover_photo_id" => $value['cover_photo_id'],
                ]
            ]);
        }
    }

    /**
     * Generating post
     *
     * @param array $data
     */
    public function generateBlog(array $data)
    {
        if(!file_exists(public_path('assets/posts')))
            $this->createWebsiteFrame();

        foreach ($data['translations'] as $value)
        {
            if(!isset($value['summary']))
                $value['summary'] = '';

            if(!isset($value['content']))
                $value['content'] = '';

            if(!isset($value['cover_photo_id']))
                $value['cover_photo_id']= 'dereva.jpg';

            $this->createFileFromTemplate([
                "destination"         => __DIR__ . '/../../../resources/views/blog/' . $value['slug'] . '.blade.php',
                "templateDestination" => __DIR__ . '/../../commands/templates/blog.html.hctpl',
                "content" => [
                    "title" => $value['title'],
                    "summary" => $value['summary'],
                    "content" => $value['content'],
                    "cover_photo_id" => $value['cover_photo_id'],
                ]
            ]);
        }
    }

    /**
     * Replace file
     * @param $configuration
     * @internal param $destination
     * @internal param $templateDestination
     * @internal param array $content
     */
    public function createFileFromTemplate(array $configuration)
    {
        $destination = $configuration['destination'];
        $templateDestination = $configuration['templateDestination'];

        if ($destination[0] == '/')
            $preserveSlash = '/';
        else
            $preserveSlash = '';

        $destination = str_replace('\\', '/', $destination);

        $template = file_get_contents($templateDestination);

        if (isset($configuration['content']))
            $template = replaceBrackets($template, $configuration['content']);

        $directory = array_filter(explode('/', $destination));
        array_pop($directory);
        $directory = $preserveSlash . implode('/', $directory);

        app('interactivesolutions\honeycombcore\commands\HCCommand')->createDirectory($directory);
        file_put_contents($destination, $template);
    }

    public function createWebsiteFrame()
    {

        $fileList = [
            //assets/posts/css
            [
                "destination"         => base_path('public/assets/posts/css/clean-blog.css'),
                "templateDestination" => __DIR__ . '/../../commands/templates/css/clean-blog.css.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/css/clean-blog.min.css'),
                "templateDestination" => __DIR__ . '/../../commands/templates/css/clean-blog.min.css.hctpl',
            ],
            //assets/posts/js
            [
                "destination"         => base_path('public/assets/posts/js/clean-blog.js'),
                "templateDestination" => __DIR__ . '/../../commands/templates/js/clean-blog.js.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/js/clean-blog.min.js'),
                "templateDestination" => __DIR__ . '/../../commands/templates/js/clean-blog.min.js.hctpl',
            ],
            [
                "destination"         =>base_path('public/assets/posts/js/contact_me.js'),
                "templateDestination" => __DIR__ . '/../../commands/templates/js/contact_me.js.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/js/jqBootstrapValidation.js'),
                "templateDestination" => __DIR__ . '/../../commands/templates/js/jqBootstrapValidation.js.hctpl',
            ],
            //assets/posts/less
            [
                "destination"         => base_path('public/assets/posts/less/clean-blog.less'),
                "templateDestination" => __DIR__ . '/../../commands/templates/less/clean-blog.less.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/less/mixins.less'),
                "templateDestination" => __DIR__ . '/../../commands/templates/less/mixins.less.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/less/variables.less'),
                "templateDestination" => __DIR__ . '/../../commands/templates/less/variables.less.hctpl',
            ],
            //
            //assets/posts/vendor/css
            [
                "destination"         => base_path('public/assets/posts/bootstrap/css/bootstrap.css'),
                "templateDestination" => __DIR__ . '/../../commands/templates/bootstrap/css/bootstrap.css.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/bootstrap/css/bootstrap.min.css'),
                "templateDestination" => __DIR__ . '/../../commands/templates/bootstrap/css/bootstrap.min.css.hctpl',
            ],
            //assets/posts/bootstrap/js
            [
                "destination"         => base_path('public/assets/posts/bootstrap/js/bootstrap.js'),
                "templateDestination" => __DIR__ . '/../../commands/templates/bootstrap/js/bootstrap.js.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/bootstrap/js/bootstrap.min.js'),
                "templateDestination" => __DIR__ . '/../../commands/templates/bootstrap/js/bootstrap.min.js.hctpl',
            ],
            //assets/posts/bootstrap/jquery
            [
                "destination"         => base_path('public/assets/posts/bootstrap/jquery/jquery.js'),
                "templateDestination" => __DIR__ . '/../../commands/templates/bootstrap/jquery/jquery.js.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/bootstrap/jquery/jquery.min.js'),
                "templateDestination" => __DIR__ . '/../../commands/templates/bootstrap/jquery/jquery.min.js.hctpl',
            ],
            //assets/posts/font-awesome/css
            [
                "destination"         => base_path('public/assets/posts/font-awesome/css/font-awesome.css'),
                "templateDestination" => __DIR__ . '/../../commands/templates/font-awesome/css/font-awesome.css.hctpl',
            ],
            [
                "destination"         => base_path('public/assets/posts/font-awesome/css/font-awesome.min.css'),
                "templateDestination" => __DIR__ . '/../../commands/templates/font-awesome/css/font-awesome.min.css.hctpl',
            ],
        ];

        foreach ($fileList as $value)
            if (!file_exists($value['destination']))
                $this->createFileFromTemplate($value);
    }
}
