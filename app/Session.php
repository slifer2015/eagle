<?php

namespace App;

use App\Repositories\ShamsiTrait;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use ShamsiTrait;
    protected $table='sessions';

    protected $fillable=[
        'title','description','file','active','user_id','level',
        'course_id','capacity','duration','level','num_like','num_dislike','num_comment'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function attachments(){
        return $this->morphMany('App\Attachment','parentable');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function comments(){
        return $this->morphMany('App\Comment','parentable');
    }

    public function scopeActive($query){
        return $query->where('active',1);
    }
}
