<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Categorium extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'categoria';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'estado',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['resource_url'];

    /* ================== RELACIONES ================== */

    public function palabras()
    {
        return $this->hasMany(Palabra::class, 'categoria_id');
    }

    /* ================== MEDIA ================== */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagen')
            ->singleFile();
    }

    /* ================== ACCESSOR ================== */

    public function getResourceUrlAttribute()
    {
        return url('/admin/categoria/'.$this->getKey());
    }
}