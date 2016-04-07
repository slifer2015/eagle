<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Course;
use App\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.latestArticles', function($view){
            $latestArticles = Article::published()->active()->latest()->take(10)->get();
            $view->with(['latestArticles'=>$latestArticles]);
        });

        view()->composer('partials.latestCourses', function($view){
            $latestCourses = Course::latest()->take(10)->get();
            $view->with(['latestCourses'=>$latestCourses]);
        });

        view()->composer('partials.latestSessions', function($view){
            $latestSessions = Session::latest()->take(10)->get();
            $view->with(['latestSessions'=>$latestSessions]);
        });

        view()->composer('partials.categories', function($view){

            $totalCategories=DB::table('categories')
                ->where('depth','=',1)
                ->leftJoin('category_course','categories.id','=','category_course.category_id')
                ->leftJoin('article_category','categories.id','=','article_category.category_id')
                ->groupBy('categories.id')
                ->select('categories.name','categories.id',DB::raw('COUNT(`course_id`) + COUNT(`article_id`) AS num'))
                ->orderBy('num','DESC')
                ->get();
            $view->with(['totalCategories'=>$totalCategories]);
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


}
