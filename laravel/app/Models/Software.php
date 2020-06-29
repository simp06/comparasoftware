<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Software extends Model
{
    use SoftDeletes;
    protected $table = 'software';
    protected $fillable = ['nombre', 'descripcion','imagen'];

    public function lenguaje()
    {
        return $this->belongsToMany(Lenguaje::class);

    }
    
    public function funcionalidad()
    {
        return $this->belongsToMany(funcionalidad::class);
    }
}
