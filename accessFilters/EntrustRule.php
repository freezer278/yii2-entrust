<?php
namespace vmorozov\entrust\accessFilters;

use \yii\base\Action;
use \yii\web\Request;
use \yii\web\User;

class EntrustRule extends \yii\filters\AccessRule
{
    /**
     * @var array list of permissions that this rule applies to.
     *
     * If this property is not set or empty, it means this rule applies to all permissions.
     */
    public $permissions;

    /**
     * Checks whether the Web user is allowed to perform the specified action.
     * @param Action $action the action to be performed
     * @param User $user the user object
     * @param Request $request
     * @return bool|null true if the user is allowed, false if the user is denied, null if the rule does not apply to the user
     */
    public function allows($action, $user, $request)
    {
        if ($this->matchAction($action)
            && $this->matchRole($user)
            && $this->matchPermission($user)
            && $this->matchIP($request->getUserIP())
            && $this->matchVerb($request->getMethod())
            && $this->matchController($action->controller)
            && $this->matchCustom($action)
        )
            return $this->allow ? true : false;
        else
            return null;
    }

    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (empty($this->roles))
            return true;

        foreach ($this->roles as $role)
        {
            if ($role === '?')
            {
                if ($user->getIsGuest())
                    return true;
            }
            elseif ($role === '@')
            {
                if (!$user->getIsGuest())
                    return true;
            }
            elseif ($user->identity->hasRole($role))
                return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    protected function matchPermission($user)
    {
        if (empty($this->permissions))
            return true;

        foreach ($this->permissions as $permission)
        {
            if ($user->identity->hasPermission($permission))
                return true;
        }

        return false;
    }

}