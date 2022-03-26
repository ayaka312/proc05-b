<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    //
    protected $table = 'exercise';
    protected $fillable = ['teacherId','title','description','filePath','modified_time'];
}
