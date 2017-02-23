# yii2-entrust
Roles and permissions system like zizaco/entrust in Laravel for Yii2.

##Installation
* Install with Composer:  
 `composer require vmorozov/tii2-entrust dev-master`
 
* Run migrations to create rbac tables  
 `php yii migrate/up --migrationPath=@vendor/vmorozov/yii2-entrust/migrations`
 
* Put it to User model:
``` 
use vmorozov\entrust\traits\EntrustUserTrait;  

class User extends ActiveRecord implements IdentityInterface
{
    use EntrustUserTrait;
    ....
    
}
```