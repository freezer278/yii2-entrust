<?php

namespace vmorozov\entrust\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 *
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['display_name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'display_name' => 'Display Name',
            'description' => 'Description',
        ];
    }

    /**
     * Get relation to permissions.
     *
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->hasMany(Permission::className(), ['id' => 'permission_id'])
            ->viaTable('permission_role', ['role_id' => 'id']);
    }

    /**
     * Get relation to users.
     *
     * @return mixed
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('role_user', ['role_id' => 'id']);
    }

    /**
     * Add given permission to role.
     *
     * @param string|Permission $permission
     */
    public function attachPermission($permission)
    {
        if (is_string($permission))
            $permission = Permission::findOne(['name' => $permission]);

        if (in_array($permission, $this->permissions))
            return;

        $this->link('permissions', $permission);
    }

    /**
     * @param string|Permission $permission
     */
    public function detachPermission($permission)
    {
        if (is_string($permission))
            $permission = Permission::findOne(['name' => $permission]);

        $this->unlink('permissions', $permission, true);
    }
}
