# Laravel Redirector

with using this package, you can manage the header status code of routes.
you can redirect or abort routes with status code.
I try to create this package like Wordpress Yoast plugin.


## Installation

Via Composer

``` bash
$ composer require amiraghaee/redirector
```

To adjust the package to your needs, you can publish the config file config/redirector.php to your project's config folder using:

``` bash
$ php artisan vendor:publish --tag=redirector
```

## Configurations

### Data Engine
This package already support two data engine!
- Redis
- Eloquent

Strongly we recommend Redis database! Eloquent maybe affect to speed of your website.<br />
Default data engine is redis, but you can change it in config/redirector.php.
accepted values are 'redis' and 'eloquent'
``` php
'engine' => 'eloquent',
```

If you have selected the Eloquent data engine, you must run the migration command to add the "redirector" table to the database.
``` bash
$ php artisan migrate
```


## Usage

Use redirector namespace on top of your controller or wherever you want:
``` php
use AmirAghaee\Redirector\Facades\Redirector;
```

### set role:
You can add roles with this method. it will be return boolean value. 
``` php
Redirector::set($route, $status, $endpoint);
```
#### parameters
| Parameter | Required | Description | Type |
| --- | --- | --- | --- |
| route | yes | The source route that you want to change the header status | string |
| status | yes | header status code. 300 range for redirect and 400 for abort | integer |
| endpoint | No | if status code was in 300 range, request will be redirect to this route | string |

### get all roles:
You can get all roles with this method. this method will be return collocation type value.
``` php
Redirector::all();
```

### get specific role:
You can get specific role with this method. this method will be return collocation type value.
``` php
Redirector::get($route);
```
#### parameters
| Parameter | Required | Description | Type |
| --- | --- | --- | --- |
| route | yes | The source route that you want get | string |

### delete specific role:
You can delete specific role with this method. this method will be return collocation type value.
``` php
Redirector::delete($route);
```
#### parameters
| Parameter | Required | Description | Type |
| --- | --- | --- | --- |
| route | yes | The source route that you want get | string |

### fresh database:
You can delete all roles with this command.
``` bash
$ php artisan redirector:refresh
```



## License

MIT. Please see the [license file](license.md) for more information.

## TODO:
- [x] Add command for fresh database!
- [x] Add eloquent database!
- [x] Add redis database!
- [ ] Add cache to eloquent database!
