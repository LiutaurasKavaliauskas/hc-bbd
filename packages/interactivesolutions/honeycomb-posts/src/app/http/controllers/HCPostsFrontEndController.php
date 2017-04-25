<?php namespace interactivesolutions\honeycombposts\app\http\controllers;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombposts\app\models\HCPosts;
use interactivesolutions\honeycombposts\app\models\HCPostsTranslations;

class HCPostsFrontEndController
{
    /**
     * Based on provided data showing content
     *
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPost(string $languageCode = null, string $slug = null)
    {
        if ($languageCode && $slug)
            return $this->showPage('posts', $languageCode, $slug);
        else
            abort(404);

    }

    /**
     * Based on provided data showing content
     *
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showBlog(string $languageCode = null, string $slug = null)
    {
        if ($languageCode && $slug)
            return $this->showPage('blog', $languageCode, $slug);
        else
            abort(404);

    }

    protected function showPage(string $type, string $languageCode, string $slug)
    {
        $r = HCPosts::getTableName();
        $t = HCPostsTranslations::getTableName();

        $list = HCPosts::select(HCPosts::getFillableFields(true))->with('translation');
        $list = $list->join($t, "$r.id", "=", "$t.record_id")
            ->where("$t.slug", $slug)
            ->where("$t.language_code", $languageCode);

        if (!$list->first())
            abort(404);

        $data = $list->first()->toArray();
        //TODO move to environment
        if ($type == 'posts')
            return view('HCPosts::post.' . $slug, ['config' => $data]);
        elseif ($type == 'blog')
        {
            $list = HCPosts::select(HCPosts::getFillableFields(true))->with('translation');
            $list = $list->join($t, "$r.id", "=", "$t.record_id")
                ->where("$r.type", "post")
                ->where("$t.language_code", $languageCode);
            $posts = $list->get();
            $users = HCUsers::all();

            return view('HCPosts::blog.' . $slug, ['config' => $data, 'posts' => $posts, 'users' => $users, 'language' => $languageCode]);
        }
    }

}