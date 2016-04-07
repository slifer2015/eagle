<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class CategoryController extends Controller
{
    private $user;

    public function __construct(Request $request)
    {
        $this->user=$request->user();
    }

    public function index(){
        $categories=Category::where('parent_id',null)->get();
        return view('admin.category.index',compact('categories'))->with(['title'=>'مدیریت دسته بندی ها','hasEdit'=>0]);
    }

    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'name'=>'required'
        ]);
        Category::create(['name'=>$request->input('name')]);
        Flash::success(trans('users.categoryCreated'));
        return redirect()->back();
    }

    public function categoryEdit(Category $categoryEdit){
        $categories=Category::where('parent_id',null)->get();
        return view('admin.category.index',compact('categories','categoryEdit'))->with(['title'=>'ویرایش دسته بندی','hasEdit'=>1]);
    }

    public function update(Category $category,Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        $category->update(['name'=>$request->input('name')]);
        Flash::success(trans('users.categoryUpdated'));
        return redirect(route('admin.category.index'));
    }

    public function delete(Category $category){
        $category->delete();
        Flash::success(trans('users.categoryDeleted'));
        return redirect(route('admin.category.index'));
    }


    /**
     * Created By Dara on 14/2/2016
     * subCategory index
     */
    public function subCategoryIndex(Category $category){
        $subCategories=$category->getDescendants();
        return view('admin.category.subCategory',compact('subCategories','category'))->with([
            'title'=>"ویرایش زیرمجموعه ها",
            'hasEdit'=>0
        ]);
    }

    /**
     * Created By Dara on 14/2/2016
     * subCategory store
     */
    public function subCategoryStore(Category $category,Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        $category->children()->create([
            'name'=>$request->input('name')
        ]);
        Flash::success(trans('users.subCategoryCreated'));
        return redirect(route('admin.category.subCategory.index',$category->id));
    }

    /**
     * Created By Dara on 14/2/2016
     * subCategory edit
     */
    public function subCategoryEdit(Category $category,Category $subCategoryEdit){
        $subCategories=$category->getDescendants();
        return view('admin.category.subCategory',compact('subCategories','category','subCategoryEdit'))->with([
            'title'=>"ویرایش زیرمجموعه ها",
            'hasEdit'=>1
        ]);
    }

    /**
     * Created By Dara on 14/2/2016
     * subCategory update
     */
    public function subCategoryUpdate(Category $category,Category $subCategory,Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        $subCategory->update(['name'=>$request->input('name')]);
        Flash::success(trans('users.subCategoryUpdated'));
        return redirect(route('admin.category.subCategory.index',[$category->id]));
    }

    /**
     * Created By Dara on 14/2/2016
     * subCategory delete
     */
    public function subCategoryDelete(Category $category,Category $subCategory){
        $subCategory->delete();
        Flash::success(trans('users.subCategoryDeleted'));
        return redirect(route('admin.category.subCategory.index',[$category->id]));
    }

    /**
     * Created By Dara on 14/2/2046
     * get the sub category via ajax when main category changes
     */
    public function getSubCategory(Request $request){
        $category_id=intval($request->input('category_id'));
        $categories=Category::where('id',$category_id)->first()->getDescendants();
        //dd($categories);
        return $categories;
    }
}
