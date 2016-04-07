<?php

namespace App;

use App\Repositories\ShamsiTrait;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use ShamsiTrait;
    protected $table='courses';

    protected $fillable=[
        'user_id',
        'title',
        'description',
        'price',
        'image',
        'num_student',
        'num_dislike',
        'num_like',
        'num_comment',
        'active',
        'sub_category_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function sessions(){
        return $this->hasMany('App\Session');
    }

    public function comments(){
        return $this->morphMany('App\Comment','parentable');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function getHumanPriceAttribute(){
        if($this->attributes['price'] > 0){
            return number_format($this->attributes['price']).' تومان ';
        }else{
            return 'رایگان';
        }
    }

}
