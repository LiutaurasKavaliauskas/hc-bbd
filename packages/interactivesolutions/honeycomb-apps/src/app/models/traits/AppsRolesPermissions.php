<?php

namespace interactivesolutions\honeycombapps\app\models\traits;

trait AppsRolesPermissions
{
    /**
     * Checking if application token has permission
     *
     * @param $permission
     * @return bool
     */
    public function hasTokenPermission (string $permission)
    {
        //TODO finalize validating permissions
        return true;
    }
}