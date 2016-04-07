<?php

namespace App;

use App\Repositories\ShamsiTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use ShamsiTrait, SoftDeletes;

    protected $table='articles';

    protected $fillable=[
        'title','content','image','published','active','num_comment',
        'num_visit','num_like','num_dislike','sub_category_id'
    ];

    public function scopePublished($query){
        return $query->where('published', 1);
    }

    public function scopeUnpublished($query){
        return $query->where('published', 0);
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeInactive($query){
        return $query->where('active', 0);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function comments(){
        return $this->morphMany('App\Comment','parentable');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }


}
