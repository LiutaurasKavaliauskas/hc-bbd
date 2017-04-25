<?php namespace interactivesolutions\honeycombpages\app\http\controllers;

use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombpages\app\models\HCPages;
use interactivesolutions\honeycombpages\app\models\HCPagesTranslations;

class HCPagesFrontEndController extends HCBaseController
{
    /**
     * Based on provided data showing content
     *
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showData(string $langCode = null, string $slug = null)
    {
        //URL -> pages/2017/03/23/page-name

        if ($langCode && $slug)
            return $this->showPage($langCode, $slug);

    }

    protected function showPage(string $langCode, string $slug)
    {
        $r = HCPages::getTableName();
        $t = HCPagesTranslations::getTableName();

        $list = HCPages::select(HCPages::getFillableFields(true))->with('translation');
        $list = $list->join($t, "$r.id", "=", "$t.record_id")
            ->where("$t.slug", $slug)
            ->where("$t.language_code", $langCode);

        if(!$list->first())
            abort(404);

        $data = $list->first()->toArray();


        //TODO move to environment
        return view('HCPages::page.' . $slug, ['config' => $data]);
    }

}
