<?php

namespace App;

use App\Repositories\ShamsiTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use ShamsiTrait;
    protected $table='comments';

    protected $fillable=['user_id','parentable_id','parentable_type','content','active','num_like','num_dislike','parent_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function parentable(){
        return $this->morphTo();
    }

    /**
     * Created By Dara on 8/2/2016
     * get the reply of comment
     */
    public function children(){
        return $this->hasMany('App\Comment','parent_id','id');
    }
}
