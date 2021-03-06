<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Comment;
use App\Course;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //
        parent::boot($router);

        $router->model('article' , 'App\Article');
        $router->model('category' , 'App\Category');
        $router->model('subCategory' , 'App\Category');
        $router->model('course' , 'App\Course');
        $router->model('session' , 'App\Session');
        $router->model('profile' , 'App\User');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
