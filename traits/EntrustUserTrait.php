<?php
namespace vmorozov\entrust\traits;

use vmorozov\entrust\models\Role;
use vmorozov\entrust\models\Permission;

/**
 * Trait to make getting access to role system in User model easier.
 *
 * Class EntrustUserTrait
 * @package vmorozov\entrust\traits
 */
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
     * Get Role of user.
     *
     * @return mixed
     */
    public function role()
    {
        return $this->roles()->one();
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
