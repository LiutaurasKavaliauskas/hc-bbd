<?php

use interactivesolutions\honeycomblanguages\app\models\HCLanguages;

if (!function_exists ('getHCFrontEndLanguages')) {

    /**
     * Getting available frontEnd languages
     *
     * @param bool $asArray
     * @return mixed
     */
    function getHCFrontEndLanguages(bool $asArray = true)
    {
        return getHCLanguages('front_end', $asArray);
    }
}

if (!function_exists ('getHCBackEndLanguages')) {

    /**
     * Getting available backend languages
     *
     * @param bool $asArray
     * @return mixed
     */
    function getHCBackEndLanguages(bool $asArray = true)
    {
        return getHCLanguages('back_end', $asArray);
    }
}

if (!function_exists ('getHCContentLanguages')) {

    /**
     * Getting available content languages
     *
     * @param bool $asArray
     * @return mixed
     */
    function getHCContentLanguages(bool $asArray = true)
    {
        return getHCLanguages('content', $asArray);
    }
}

if (!function_exists('getHCLanguages'))
{
    /**
     * Retrieving languages
     *
     * @param string $key
     * @param bool $asArray
     * @return mixed
     */
    function getHCLanguages(string $key, bool $asArray = true)
    {
        $list = HCLanguages::where($key, 1)->get();

        if ($asArray)
            return $list->pluck('iso_639_1')->toArray();

        return $list;
    }
}