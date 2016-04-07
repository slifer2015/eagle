<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class ArticleController extends Controller
{
    private $user;

    public function __construct(Request $request){
        $this->user=$request->user();
    }

    public function index()
    {
        $articles = Article::published()->latest()->paginate(15);
        return view('article.list',compact('articles'))->with(['title'=>'مقالات نمآموز']);
    }

    public function preview(Article $article){
        $user = $this->user;
        return view('article.preview',compact('article','user')
        )->with([
            'title'=>$article->title,
            'meta_description'=>str_limit(strip_tags($article->content), 120, '...'),
            'meta_keywords'=>implode(', ', $article->tags()->lists('name')->toArray())
        ]);
    }

    public function upload(Request $request) //add middleware of ajax and remove the if
    {
        if ($request->ajax()) {
            $user = $request->user();
            /* upload image */
            $imageName = str_random(20) . $user->id . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path() . '/img/files/' . $user->id, $imageName);
            return asset('img/files/' . $user->id . '/' . $imageName);
        } else {
            abort(403);
        }
    }

    public function delete(Request $request)
    {
        $user = $request->user();
        $path = parse_url($request->input('src'), PHP_URL_PATH);
        $pathFragments = explode('/', $path);
        $imageName = end($pathFragments);
        $path = public_path('img/files/' . $user->id . '/' . $imageName);
        if (File::exists($path)) {
            unlink($path);
        }

    }

    public function create()
    {
        $user = $this->user;
        $mainCategories = Category::roots()->lists('name', 'id');
        $main = [];
        $main[0] = 'انتخاب کنید';
        foreach ($mainCategories as $key => $value) {
            $main[$key] = $value;
        }
        return view('admin.article.create',compact('main'))->with(['title' => 'ثبت مقاله جدید']);
    }

    public function store(Request $request)
    {
        $user = $this->user;
        //dd($request->all());
        $this->validate($request, [
            'title' => 'required|min:3',
            'published' => 'required|in:0,1',
            'content' => 'required|min:3',
            'categories.*' => 'integer|min:1',
            'image' => 'mimes:jpeg,bmp,png,jpg|max:1024',
            'tags.*'=>'string|max:30|min:2',
        ]);
        $input = $request->all();
        /* check if the user has uploaded image or not */
        if ($request->hasFile('image')) {
            $image = $input['image'];
            $imageName = $user->id . str_random(20) . '.' . $image->getClientOriginalExtension();
            $imageDbName=$user->id.'/'.$imageName;
            $image->move(public_path('img/files/'.$user->id),$imageName);
        } else {
            $imageDbName = '';
        }

        /*create article*/
        $article = $user->articles()->create([
            'title' => $input['title'],
            'content' => $input['content'],
            'published' => $input['published'],
            'image' => $imageDbName,
        ]);

        /*register subCategories*/
        $selectedCategories=$this->registerSubCategories($request);
        if(!$selectedCategories){//if the selected tags has error
            return redirect()->back();
        }
        $article->categories()->sync($selectedCategories);

        /*register tags*/
        $selectedTags = $this->registerTags($request);
        if(!$selectedTags){//if the selected tags has error
            return redirect()->back();
        }
        $article->tags()->sync($selectedTags);

        Flash::success(trans('users.articleCreated'));
        return redirect()->back();
    }

    public function edit(Article $article)
    {
        $user = $this->user;
        $mainCategories = Category::roots()->lists('name', 'id');
        $main = [];
        $main[0] = 'انتخاب کنید';
        foreach ($mainCategories as $key => $value) {
            $main[$key] = $value;
        }
        $subCategoriesQuery=$article->categories();
        $subCategories=$subCategoriesQuery->lists('name','id');
        //dd($subCategories);
        $selectedMainCategory=$subCategoriesQuery->getParent()->id;
        $tagsQuery = $article->tags();
        $tags = $tagsQuery->lists('name','name');
        $selected = $tagsQuery->lists('name')->toArray();

        return view('admin.article.edit', compact('article', 'user', 'tags', 'selected'))->with([
            'title' => 'ویرایش مقاله',
            'main'=>$main,
            'subCategories'=>$subCategories,
            'selectedMainCategory'=>$selectedMainCategory,
            'selectedSubCategories'=>$subCategoriesQuery->lists('id')->toArray()
        ]);
    }

    public function update(Article $article, Request $request)
    {
        $user = $this->user;
        //dd($request->all());
        $this->validate($request, [
            'title' => 'required|min:3',
            'published' => 'required|in:0,1',
            'content' => 'required|min:3',
            'image' => 'mimes:jpeg,bmp,png,jpg|max:1024',
            'tags.*'=>'min:2|max:30',
            'categories.*'=>'integer'
        ]);
        $input = $request->all();
        $previousImage = $article->image;
        /* check if the user has uploaded image or not */
        if ($request->hasFile('image')) {
            $image = $input['image'];
            $imageName = $user->id . str_random(20) . '.' . $image->getClientOriginalExtension();
            $imageDbName = $user->id.'/'.$imageName;
            $image->move(public_path() . '/img/files/' . $user->id, $imageName);
            /* Delete the previous image */
            if ($previousImage != null) {
                if (File::exists(public_path() . '/img/files/' . $user->id . '/' . $previousImage)) {
                    unlink(public_path() . '/img/files/' . $user->id . '/' . $previousImage);
                }
            }
        } else {
            $imageDbName = $previousImage;
        }

        /*update article*/
        $article->update([
            'title' => $input['title'],
            'content' => $input['content'],
            'published' => $input['published'],
            'image' => $imageDbName,
        ]);

        /*register subCategories*/
        $selectedCategories=$this->registerSubCategories($request);
        if(!$selectedCategories){//if the selected tags has error
            return redirect()->back();
        }
        $article->categories()->sync($selectedCategories);

        /*register tags*/
        $selected = $this->registerTags($request);
        $article->tags()->sync($selected);

        Flash::success(trans('users.articleEdited'));
        return redirect()->back();
    }

    public function adminIndex(){
        $articles = Article::all();
        return view('admin.article.list',compact('articles'))->with(['title'=>'مقالات']);
    }

    private function registerTags($request)
    {
        $selected = $request->input('tags');
        if(count($selected)>4){ //the user can select up to 4 tags
            //do nothing
        }else{
            $selectedIds=[];
            foreach($selected as $select){
                if($tag=Tag::where('name',$select)->first()){ //already exists
                    $selectedIds[]=$tag->id;
                }else{
                    $newTag=Tag::create(['name'=>$select]);
                    $selectedIds[]=$newTag->id;
                }
            }
            return $selectedIds;
        }
        return false;
    }

    /**
     * Created By Dara on 14/3/2016
     * register subCategories
     */
    private function registerSubCategories($request){
        $selected = $request->input('categories');
        if(count($selected)>4){ //the user can select up to 4 tags
            //do nothing
        }else{
            return $selected;
        }
        return false;
    }

    public function comments(Article $article){
        return $article;
    }


}
