# yii2-entrust
Roles and permissions system like zizaco/entrust in Laravel for Yii2.

##Installation
* Install with Composer:  
 `composer require vmorozov/tii2-entrust dev-master`
 
* Run migrations to create rbac tables  
 `php yii migrate/up --migrationPath=@vendor/vmorozov/yii2-entrust/migrations`
 
* Put given code to User model:
```php
use vmorozov\entrust\traits\EntrustUserTrait;  

class User extends ActiveRecord implements IdentityInterface
{
    use EntrustUserTrait; // insert this line
    ....
    
}
```
##Usage
####Get Permissions Of User
```php
// get permissions relation of user. You can manipulate with it as you want.
$user->permissions()

// get all permissions of user
$user->permissions()->all()

// configure getting permissions with sql query methods
$user->permissions()->where(['like', 'name', 'test%'])->all()
```
####Get user role
```php
$role = $user->role(); 
// returns vmorozov\entrust\models\Role Object
```
####Check if user has permission
```php
$user->hasPermission('create-post');
// returns true if user has permission with given name
```
