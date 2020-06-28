<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Lenguaje extends Model
{
    protected $table = 'lenguaje';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function software()
    {
        return $this->belongsToMany(Software::class);

    }
}
