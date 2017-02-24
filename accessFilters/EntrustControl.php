<?php
namespace vmorozov\entrust\accessFilters;

use \Yii;

/**
 * EntrustControl provides simple access control based on a set of rules.
 * Just like AccessControl.
 *
 * To use EntrustControl, declare it in the `behaviors()` method of your controller class.
 * For example, the first rule will allow users with permissions 'create-post' or 'update-post',
 * the second rule will allow authenticated users
 * to access the "create" and "update" actions
 * and deny all other users from accessing these two actions.
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         'access' => [
 *             'class' => \vmorozov\entrust\accessFilters\EntrustControl::className(),
 *             'only' => ['create', 'update'],
 *             'rules' => [
 *                 // allow to all users who have 'create-post' or 'update-post' permission
 *                 [
 *                     'allow' => true,
 *                     'permissions' => ['create-post', 'update-post']
 *                 ],
 *                 // allow authenticated users
 *                 [
 *                     'allow' => true,
 *                     'roles' => ['@'],
 *                 ],
 *                 // everything else is denied
 *             ],
 *         ],
 *     ];
 * }
 * ```
 */
class EntrustControl extends \yii\filters\AccessControl
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $user = $this->user;
        $request = Yii::$app->getRequest();
        /* @var $rule EntrustRule */
        foreach ($this->rules as $rule) {
            if ($allow = $rule->allows($action, $user, $request)) {
                return true;
            } elseif ($allow === false) {
                if (isset($rule->denyCallback)) {
                    call_user_func($rule->denyCallback, $rule, $action);
                } elseif ($this->denyCallback !== null) {
                    call_user_func($this->denyCallback, $rule, $action);
                } else {
                    $this->denyAccess($user);
                }
                return false;
            }
        }
        if ($this->denyCallback !== null) {
            call_user_func($this->denyCallback, null, $action);
        } else {
            $this->denyAccess($user);
        }
        return false;
    }
}