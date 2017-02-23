<?php
namespace vmorozov\entrust\traits;

use vmorozov\entrust\models\Permission;
use vmorozov\entrust\models\Role;

trait EntrustUserTrait
{
    /**
     * Many-to-Many relations with Role.
     *
     */
    public function roles()
    {
        return $this->hasMany(Role::className(), ['id' => 'role_id'])
            ->viaTable('role_user', ['user_id' => 'id']);
    }

    /**
     * Many-to-Many relations with Permission.
     *
     */
    public function permissions()
    {
        return $this->hasMany(Permission::className(), ['id' => 'permission_id'])
            ->viaTable('permission_user', ['user_id' => 'id']);
    }

    /**
     * Checks if this user has permission with given name.
     *
     * @param string $permissionName - name of permission.
     *
     * @return bool
     */
    public function hasPermission(string $permissionName)
    {
        if ($this->permissions()->where(['name' => $permissionName])->count() >= 1)
            return true;
        return false;
    }

}
