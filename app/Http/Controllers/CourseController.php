<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Laracasts\Flash\Flash;

class CourseController extends Controller
{
    private $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    public function index(){
        $courses = Course::latest()->get();
        return view('course.list',compact('courses'))->with(['title'=>'دوره های آموزشی آنلاین']);
    }

    public function create()
    {
        $mainCategories = Category::roots()->lists('name', 'id');
        $main = [];
        $main[0] = 'انتخاب کنید';
        foreach ($mainCategories as $key => $value) {
            $main[$key] = $value;
        }
        //dd($mainCategories);
        return view('admin.course.create', compact('main'))->with(['title' => 'افزودن دوره آموزشی']);
    }

    public function store(Request $request)
    {
        $user = $this->user;
        $this->validate($request, [
            'title' => 'required|min:3',
            'active' => 'required|in:0,1',
            'description' => 'required|min:3',
            'categories.*' => 'integer',
            'price' => 'required|integer',
            'image' => 'mimes:jpeg,bmp,png,jpg|max:1024',
            'tags.*'=>'min:2|max:30'
        ]);
        $input = $request->all();
        /* check if the user has uploaded image or not */
        if ($request->hasFile('image')) {
            $image = $input['image'];
            $imageName = $user->id . str_random(20) . '.' . $image->getClientOriginalExtension();
            $dbImageName = $user->id . '/' . $imageName;
            $image->move(public_path() . '/img/files/' . $user->id, $imageName);
        } else {
            $dbImageName = '';
        }

        /*create course*/
        $course = $user->courses()->create([
            'title' => $input['title'],
            'description' => $input['description'],
            'active' => $input['active'],
            'price' => $input['price'],
            'image' => $dbImageName
        ]);

        /*register subCategories*/
        $selectedCategories=$this->registerSubCategories($request);
        if(!$selectedCategories){//if the selected tags has error
            return redirect()->back();
        }
        $course->categories()->sync($selectedCategories);

        /*register tags*/
        $selected = $this->registerTags($request);
        if(!$selected){
            return redirect()->back();
        }
        $course->tags()->sync($selected);

        Flash::success(trans('users.courseCreated'));
        return redirect()->back();
    }

    public function edit(Course $course)
    {
        $user = $this->user;
        $mainCategories = Category::roots()->lists('name', 'id');
        $main = [];
        $main[0] = 'انتخاب کنید';
        foreach ($mainCategories as $key => $value) {
            $main[$key] = $value;
        }

        $subCategoriesQuery=$course->categories();
        $subCategories=$subCategoriesQuery->lists('name','id');
        //dd($subCategories);
        $selectedMainCategory=$subCategoriesQuery->getParent()->id;
        $tagsQuery = $course->tags();
        $tags = $tagsQuery->lists('name','name');
        $selected = $tagsQuery->lists('name')->toArray();

        return view('admin.course.edit', compact('course', 'user', 'tags', 'selected'))->with([
            'title' => 'ویرایش دوره',
            'main'=>$main,
            'subCategories'=>$subCategories,
            'selectedMainCategory'=>$selectedMainCategory,
            'selectedSubCategories'=>$subCategoriesQuery->lists('id')->toArray()
        ]);
    }

    public function update(Course $course,Request $request){
        $user = $this->user;
        $this->validate($request, [
            'title' => 'required|min:3',
            'active' => 'required|in:0,1',
            'description' => 'required|min:3',
            'categories.*' => 'integer',
            'price' => 'required|integer',
            'image' => 'mimes:jpeg,bmp,png,jpg|max:1024'
        ]);
        $input = $request->all();
        $previousImage = $course->image;
        /* check if the user has uploaded image or not */
        if ($request->hasFile('image')) {
            $image = $input['image'];
            $imageName = $user->id . str_random(20) . '.' . $image->getClientOriginalExtension();
            $dbImageName = $user->id . '/' . $imageName;
            $image->move(public_path() . '/img/files/' . $user->id, $imageName);
            if ($previousImage != null) {
                if (File::exists(public_path() . '/img/files/'. $previousImage)) {
                    unlink(public_path() . '/img/files/'. $previousImage);
                }
            }
        } else {
            $dbImageName = $previousImage;
        }

        /*create course*/
        $course->update([
            'title' => $input['title'],
            'description' => $input['description'],
            'active' => $input['active'],
            'price' => $input['price'],
            'image' => $dbImageName
        ]);

        /*register subCategories*/
        $selectedCategories=$this->registerSubCategories($request);
        if(!$selectedCategories){//if the selected tags has error
            return redirect()->back();
        }
        $course->categories()->sync($selectedCategories);

        /*register tags*/
        $selected = $this->registerTags($request);
        if(!$selected){//if the selected tags has error
            return redirect()->back();
        }
        $course->tags()->sync($selected);

        Flash::success(trans('users.courseUpdated'));
        return redirect()->back();
    }

    public function adminIndex(){
        $user=$this->user;
        $courses=Course::all();
        return view('admin.course.list',compact('courses'))->with(['title'=>'دوره های آموزشی']);
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

    public function preview(Course $course){
        $user=$this->user;
        return view('course.preview',compact('course','user'))
            ->with([
                'title'=>$course->title,
                'meta_description'=>str_limit(strip_tags($course->description), 120, '...'),
                'meta_keywords'=>implode(', ', $course->tags()->lists('name')->toArray())
            ]);
    }
}
