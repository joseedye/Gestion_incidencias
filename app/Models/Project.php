<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'descripcion',
        'start',
    ];

    public static $rules=[
        'name'=>'required',
        //'descripcion'=> '',
        'start'=>'date'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function categories(){
        return $this->hasMany('App\Models\Category');
    }

    public function levels(){
        return $this->hasMany('App\Models\Level');
    }

    public function getFirstLevelIdAttribute(){
        return $this->levels->first()->id;
    }
}
