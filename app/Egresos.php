<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egresos extends Model
{
    protected $fillable = ['nombre','valor','detalle','categorias_ings_id'];
    protected $guarded = [];
    protected $primaryKey = 'id';
    public $incrementing = false; 
    public $timestamps = false; 

    public function categorias_ings()
    {
        return $this->belongsTo(CategoriasIng::class);
    }

}
