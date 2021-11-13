<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    // protected $fillable = ['url'];
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function support()
    {
        return $this->belongsTo('App\Models\User', 'support_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'client_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');   
    }

    public static $rules = [
        'category_id' => 'sometimes|exists:categories,id',
        'severity' => 'required|in:M,N,A',
        'title' => 'required|min:5',
        'description' => 'required|min:15'
    ];

    public static $messages = [
        'category_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos.',
        'title.required' => 'Es necesario ingresar un título para la incidencia.',
        'title.min' => 'El título debe presentar al menos 5 caracteres.',
        'description.required' => 'Es necesario ingresar una descripción para la incidencia.',
        'description.min' => 'La descripción debe presentar al menos 15 caracteres.'
    ];
    
    public function getSeverityFullAttribute(){
       switch($this->severity){
            case'M':
                return 'Menor';
            case'N':
                return 'Normal';
            default:
                return 'Alta';
       } 
    }

    public function getTitleShortAttribute(){
        return mb_strimwidth($this->title,0 ,20, '...');
    }
    // category_name
    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->name;

        return 'General';
    }

    // support_name
    public function getSupportNameAttribute()
    {
        if ($this->support)
            return $this->support->name;

        return 'Sin asignar';
    }

    public function getStateAttribute()
    {
        if ($this->active == 0)
            return 'Resuelto';

        if ($this->support_id)
            return 'Asignado';

        return 'Pendiente';
    }
}
