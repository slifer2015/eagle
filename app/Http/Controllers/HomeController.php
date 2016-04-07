<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Course;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    private $config;

    public function __construct()
    {
        $this->config = Config::get('general');
    }

    public function index()
    {
        $courses = Course::latest()->get();
        $articles = Article::published()->active()->latest()->paginate(10);
        return view('home.index', compact('courses', 'articles'))
            ->with([
                'title'=>$this->config['title'],
                'meta_description'=>$this->config['description'],
                'meta_keywords'=>$this->config['keywords']
            ]);
    }

    public function category(Category $category){
        $courses = $category->courses()->get();
        $articles = $category->articles()->published()->active()->latest()->paginate(10);
        return view('home.index', compact('courses', 'articles'))
            ->with([
                'title'=>$category->name,
                'meta_description'=>$this->config['description'],
                'meta_keywords'=>$this->config['keywords']
            ]);
    }
}
