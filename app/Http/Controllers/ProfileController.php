<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    private $user;

    public function __construct(Request $request)
    {
        $this->user=$request->user();
    }

    public function index()
    {
        $user = $this->user;
        return view('home.profile', compact('user'))->with(['title' => $user->full_name]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $this->validate($request, [
            'first_name' => 'required',
            'last_name'=>'required',
            'image' => 'mimes:jpeg,bmp,png,jpg|max:1024'
        ]);
        $input=$request->all();
        $previousImage=$user->image;
        /* check if the user has uploaded image or not */
        if($request->hasFile('image')){
            $image=$input['image'];
            $imageName=$user->id.str_random(20).'.'.$image->getClientOriginalExtension();
            $image->move(public_path().'/img/persons/',$imageName);
            /* Delete the previous image */
            if($previousImage!=null){
                if(File::exists(public_path().'/img/persons/'.$previousImage)){
                    unlink(public_path().'/img/persons/'.$previousImage);
                }
            }
        }else{
            $imageName=$previousImage;
        }

        $user->update([
            'first_name'=>$input['first_name'],
            'last_name'=>$input['last_name'],
            'description'=>$input['description'],
            'image'=>$imageName
        ]);
        Flash::success(trans('users.profileUpdated'));
        return redirect()->back();
    }

    /**
     * Created By Dara on 13/3/2016
     * show profile to public
     */
    public function publicShow(User $user){
        $articles=$user->articles()->published()->active()->orderBy('created_at','DESC')->paginate(10);
        $courses=$user->courses()->orderBy('created_at','DESC')->get();
        return view('profile.index',compact('user','articles','courses'))->with([
            'title'=>$user->full_name,
            'meta_description'=>$user->description,
        ]);
    }
}
