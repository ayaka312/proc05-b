<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SbmExercise extends Model
{
    //
    protected $table = 'sbmexercise';
    protected $fillable = ['exerciseId', 'studentId','filePath'];
}
