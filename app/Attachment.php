<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table='attachments';

    protected $fillable=['real_name','user_id','size','file','parentable_type','parentable_id'];

    public function parentable(){
        $this->morphTo();
    }
}
