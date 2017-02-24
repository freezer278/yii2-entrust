# yii2-entrust
Roles and permissions system like zizaco/entrust in Laravel for Yii2.  

##Description
This plugin helps you to manage users roles and permissions very fast and easily.  
**Roles** are presets of permissions. So it means that you have **_independent_** control of each user permissions.  
So after assigning role to some user will assign all permissions assigned to role to this user.


##Installation
#####IMPORTANT!
#####Before installing this plugin you should have fully configured User model to work with database.  
#####And you should have table with users with any name attached to User model in your database.
#####In the other case you will get the error while running plugin migration. 

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

####Create role and Permission
```php
// create role
$adminRole = new Role();
$adminRole->attributes = [
    'name' => 'admin', // short name for use in code
    'display_name' => 'Admin', // More beautiful name to display it to users if it is needed
    'description' => 'Administrator (has all permissions)', // Description of role
];
$adminRole->save();

// create permission
$create_post_permission = new Permission();
$create_post_permission->attributes = [
    'name' => 'create_post', // short name for use in code
    'display_name' => 'Create Post', // More beautiful name to display it to users if it is needed
    'description' => 'Permission to create new post', // Description of permission
];
$create_post_permission->save();
```
####Assign Permissions to Role
```php
// add permission to role with permission name string
$adminRole->attachPermission('create_post');
// add permission to role with permission object
$adminRole->attachPermission($create_post_permission);


// remove permission from role with permission name string
$adminRole->detachPermission('create_post');
// remove permission from role with permission object
$adminRole->detachPermission($create_post_permission);
```
####Assign Permissions Directly To User
```php
// add permission to user with permission name string
$user->attachPermission('create_post');
// add permission to user with permission object
$user->attachPermission($create_post_permission);


// remove permission from user with permission name string
$user->detachPermission('create_post');
// remove permission from user with permission object
$user->detachPermission($create_post_permission);
```
####Check if user has permission
```php
$user->hasPermission('create-post');
// returns true if user has permission with given name
```
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
