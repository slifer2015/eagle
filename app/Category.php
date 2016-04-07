<?php

namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class Category extends Node
{
    protected $table='categories';

    protected $fillable=['name'];

    public function courses(){
        return $this->belongsToMany('App\Course');
    }

    public function articles(){
        return $this->belongsToMany('App\Article');
    }

}
