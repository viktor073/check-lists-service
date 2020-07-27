<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Access\Gate;

class AuthorizeResource extends Authorize
{
    /**
     * Array resource methods to ability names.
     */
    protected $resourceAbilityMap = [
            'index' => 'viewAny',
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
        ];

    /**
     *  Action Controller
     */
    protected string $action;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function __construct(Gate $gate)
    {
        $this->action = substr(Route::currentRouteName(), strripos(Route::currentRouteName(), '.') + 1);
        parent::__construct($gate);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $modelName - name <App\Model>
     * @param  array $models - <App\Model> from route
     * @return mixed
     */
    public function handle($request, Closure $next, string $modelName, string $model)
    {
        if (Route::input($model) === null) {
            $model = $modelName;
        }

        parent::handle($request, $next, $this->getActionPolicy(), $model);

        return $next($request);
    }

    /**
     * Get action Policy
     *
    * @return string
     */
    protected function getActionPolicy()
    {
        return $this->resourceAbilityMap[$this->action];
    }
}
