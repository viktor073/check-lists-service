## Практика laravel - Карякин В.П.
## Сервис чек листов

1. Админка
- Управление админами с разграничением прав
- Управление пользователями с возможностью блокировки
- Управление кол-вом возможных чек-листов у пользователя (в зависимости от роли админа, необходимо ограничивать данный функционал)
- Просмотр чек листов
2. RestAPI (перечень методов которые необходимо реализовать)
- Регистрация / Авторизация
- Создать/Удалить чек лист (учитывать настройки возможного кол-ва)
- Добавить/Удалить пункт в чек лист
- Отметить выполнен/не выполнен пункт
- Получить список чек листов
- Получить список пунктов чеклиста с указанием выполнен/не выполнен

Маршруты:
+--------+-----------+----------------------------------------------+-----------------------------------+---------------------------------------------------------------------------+-------------------------------+
| Domain | Method    | URI                                          | Name                              | Action
             | Middleware                    |
+--------+-----------+----------------------------------------------+-----------------------------------+---------------------------------------------------------------------------+-------------------------------+
|        | GET|HEAD  | /                                            |                                   | Closure
             | web                           |
|        | POST      | api/checkLists                               | checkLists.store                  | App\Http\Controllers\API\CheckListController@store
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:create,App\CheckList      |
|        | GET|HEAD  | api/checkLists                               | checkLists.index                  | App\Http\Controllers\API\CheckListController@index
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:viewAny,App\CheckList     |
|        | DELETE    | api/checkLists/{checkList}                   | checkLists.destroy                | App\Http\Controllers\API\CheckListController@destroy
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:delete,checkList          |
|        | PUT|PATCH | api/checkLists/{checkList}                   | checkLists.update                 | App\Http\Controllers\API\CheckListController@update
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:update,checkList          |
|        | GET|HEAD  | api/checkLists/{checkList}                   | checkLists.show                   | App\Http\Controllers\API\CheckListController@show
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:view,checkList            |
|        | GET|HEAD  | api/checkLists/{checkList}/itemCheckLists    | checkLists.itemCheckLists.index   | App\Http\Controllers\API\ItemCheckListController@index
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:viewAny,App\ItemCheckList |
|        | POST      | api/checkLists/{checkList}/itemCheckLists    | checkLists.itemCheckLists.store   | App\Http\Controllers\API\ItemCheckListController@store
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:create,App\ItemCheckList  |
|        | DELETE    | api/itemCheckLists/{itemCheckList}           | itemCheckLists.destroy            | App\Http\Controllers\API\ItemCheckListController@destroy
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:delete,itemCheckList      |
|        | PUT|PATCH | api/itemCheckLists/{itemCheckList}           | itemCheckLists.update             | App\Http\Controllers\API\ItemCheckListController@update
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:update,itemCheckList      |
|        | GET|HEAD  | api/itemCheckLists/{itemCheckList}           | itemCheckLists.show               | App\Http\Controllers\API\ItemCheckListController@show
             | api                           |
|        |           |                                              |                                   |
             | auth:api                      |
|        |           |                                              |                                   |
             | can:view,itemCheckList        |
|        | POST      | api/register                                 |                                   | App\Http\Controllers\API\RegisterController@register
             | api                           |
|        | POST      | checkLists                                   | checkLists.store                  | App\Http\Controllers\CheckListController@store
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        |           |                                              |                                   |
             | can:create,App\CheckList      |
|        | GET|HEAD  | checkLists                                   | checkLists.index                  | App\Http\Controllers\CheckListController@index
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        |           |                                              |                                   |
             | can:viewAny,App\CheckList     |
|        | GET|HEAD  | checkLists/create                            | checkLists.create                 | App\Http\Controllers\CheckListController@create
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        |           |                                              |                                   |
             | can:create,App\CheckList      |
|        | PUT|PATCH | checkLists/{checkList}                       | checkLists.update                 | App\Http\Controllers\CheckListController@update
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        |           |                                              |                                   |
             | can:update,checkList          |
|        | DELETE    | checkLists/{checkList}                       | checkLists.destroy                | App\Http\Controllers\CheckListController@destroy
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        |           |                                              |                                   |
             | can:delete,checkList          |
|        | GET|HEAD  | checkLists/{checkList}                       | checkLists.show                   | App\Http\Controllers\CheckListController@show
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        |           |                                              |                                   |
             | can:view,checkList            |
|        | GET|HEAD  | checkLists/{checkList}/edit                  | checkLists.edit                   | App\Http\Controllers\CheckListController@edit
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        |           |                                              |                                   |
             | can:update,checkList          |
|        | GET|HEAD  | checkLists/{checkList}/itemCheckLists        | checkLists.itemCheckLists.index   | App\Http\Controllers\ItemCheckListController@index
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | POST      | checkLists/{checkList}/itemCheckLists        | checkLists.itemCheckLists.store   | App\Http\Controllers\ItemCheckListController@store
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | checkLists/{checkList}/itemCheckLists/create | checkLists.itemCheckLists.create  | App\Http\Controllers\ItemCheckListController@create
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | home                                         | home                              | App\Http\Controllers\HomeController@index
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | itemCheckLists/{itemCheckList}               | itemCheckLists.show               | App\Http\Controllers\ItemCheckListController@show
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | PUT|PATCH | itemCheckLists/{itemCheckList}               | itemCheckLists.update             | App\Http\Controllers\ItemCheckListController@update
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | DELETE    | itemCheckLists/{itemCheckList}               | itemCheckLists.destroy            | App\Http\Controllers\ItemCheckListController@destroy
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | itemCheckLists/{itemCheckList}/edit          | itemCheckLists.edit               | App\Http\Controllers\ItemCheckListController@edit
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | login                                        | login                             | App\Http\Controllers\Auth\LoginController@showLoginForm
             | web                           |
|        |           |                                              |                                   |
             | guest                         |
|        | POST      | login                                        |                                   | App\Http\Controllers\Auth\LoginController@login
             | web                           |
|        |           |                                              |                                   |
             | guest                         |
|        | POST      | logout                                       | logout                            | App\Http\Controllers\Auth\LoginController@logout
             | web                           |
|        | POST      | oauth/authorize                              | passport.authorizations.approve   | Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve  | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | oauth/authorize                              | passport.authorizations.authorize | Laravel\Passport\Http\Controllers\AuthorizationController@authorize       | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | DELETE    | oauth/authorize                              | passport.authorizations.deny      | Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny        | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | oauth/clients                                | passport.clients.index            | Laravel\Passport\Http\Controllers\ClientController@forUser
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | POST      | oauth/clients                                | passport.clients.store            | Laravel\Passport\Http\Controllers\ClientController@store
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | DELETE    | oauth/clients/{client_id}                    | passport.clients.destroy          | Laravel\Passport\Http\Controllers\ClientController@destroy
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | PUT       | oauth/clients/{client_id}                    | passport.clients.update           | Laravel\Passport\Http\Controllers\ClientController@update
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | POST      | oauth/personal-access-tokens                 | passport.personal.tokens.store    | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@store     | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | oauth/personal-access-tokens                 | passport.personal.tokens.index    | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@forUser   | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | DELETE    | oauth/personal-access-tokens/{token_id}      | passport.personal.tokens.destroy  | Laravel\Passport\Http\Controllers\PersonalAccessTokenController@destroy   | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | oauth/scopes                                 | passport.scopes.index             | Laravel\Passport\Http\Controllers\ScopeController@all
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | POST      | oauth/token                                  | passport.token                    | Laravel\Passport\Http\Controllers\AccessTokenController@issueToken        | throttle                      |
|        | POST      | oauth/token/refresh                          | passport.token.refresh            | Laravel\Passport\Http\Controllers\TransientTokenController@refresh        | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | oauth/tokens                                 | passport.tokens.index             | Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@forUser | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | DELETE    | oauth/tokens/{token_id}                      | passport.tokens.destroy           | Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@destroy | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | POST      | password/confirm                             |                                   | App\Http\Controllers\Auth\ConfirmPasswordController@confirm
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | password/confirm                             | password.confirm                  | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm       | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | POST      | password/email                               | password.email                    | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail     | web                           |
|        | POST      | password/reset                               | password.update                   | App\Http\Controllers\Auth\ResetPasswordController@reset
             | web                           |
|        | GET|HEAD  | password/reset                               | password.request                  | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm    | web                           |
|        | GET|HEAD  | password/reset/{token}                       | password.reset                    | App\Http\Controllers\Auth\ResetPasswordController@showResetForm           | web                           |
|        | POST      | register                                     |                                   | App\Http\Controllers\Auth\RegisterController@register
             | web                           |
|        |           |                                              |                                   |
             | guest                         |
|        | GET|HEAD  | register                                     | register                          | App\Http\Controllers\Auth\RegisterController@showRegistrationForm         | web                           |
|        |           |                                              |                                   |
             | guest                         |
|        | POST      | roles                                        | roles.store                       | App\Http\Controllers\RoleController@store
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | roles                                        | roles.index                       | App\Http\Controllers\RoleController@index
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | roles/create                                 | roles.create                      | App\Http\Controllers\RoleController@create
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | roles/{role}                                 | roles.show                        | App\Http\Controllers\RoleController@show
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | PUT|PATCH | roles/{role}                                 | roles.update                      | App\Http\Controllers\RoleController@update
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | DELETE    | roles/{role}                                 | roles.destroy                     | App\Http\Controllers\RoleController@destroy
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | roles/{role}/edit                            | roles.edit                        | App\Http\Controllers\RoleController@edit
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | POST      | users                                        | users.store                       | App\Http\Controllers\UserController@store
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | users                                        | users.index                       | App\Http\Controllers\UserController@index
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | users/create                                 | users.create                      | App\Http\Controllers\UserController@create
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | users/{user}                                 | users.show                        | App\Http\Controllers\UserController@show
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | DELETE    | users/{user}                                 | users.destroy                     | App\Http\Controllers\UserController@destroy
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | PUT|PATCH | users/{user}                                 | users.update                      | App\Http\Controllers\UserController@update
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | users/{user}/block                           | block                             | App\Http\Controllers\UserController@block
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
|        | GET|HEAD  | users/{user}/edit                            | users.edit                        | App\Http\Controllers\UserController@edit
             | web                           |
|        |           |                                              |                                   |
             | auth                          |
+--------+-----------+----------------------------------------------+-----------------------------------+---------------------------------------------------------------------------+-------------------------------+