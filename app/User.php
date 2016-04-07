<?php

namespace App;


use App\Repositories\ShamsiTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use ShamsiTrait, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','active','confirmed','confirmation_code','image', 'email', 'password','description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute(){
        return $this->attributes['first_name']." ".$this->attributes['last_name'];
    }

    /**
     * Created By Dara on 1/2/2016
     * get avatar attribute
     */
    public function getAvatarAttribute(){
        if(is_null($this->attributes['image']) || $this->attributes['image']==''){
            return 'user-default-avatar.png';
        }else{
            return $this->attributes['image'];
        }
    }

    /**
     * Created By Dara on 1/2/2016
     * user active status and email confirmation status
     */
    public function getUserConfirmStatus(){
        $status=[
            0=>['name'=>trans('users.unconfirmedUser'),'type'=>'danger'],
            1=>['name'=>trans('users.confirmedUser'),'type'=>'success']
        ];
        return $status[$this->attributes['confirmed']];
    }

    public function getUserActiveStatus(){
        $status=[
            0=>['name'=>trans('users.activeUser'),'type'=>'danger'],
            1=>['name'=>trans('users.deactivedUser'),'type'=>'success']
        ];
        return $status[$this->attributes['active']];
    }

    public function articles(){
        return $this->hasMany('App\Article');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function courses(){
        return $this->hasMany('App\Course');
    }

    public function attachments(){
        return $this->hasMany('App\Attachment');
    }

    public function sessions(){
        return $this->hasMany('App\Session');
    }
}
