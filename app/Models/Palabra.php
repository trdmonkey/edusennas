<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Palabra extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'palabra';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'estado',
        'link',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categorium::class);
    }

    /**
        * Vamos a usar la libreria de spatie para manejar los videos asociados a cada palabra.
        * Esta función registra una colección de medios llamada 'videos'.
     **/
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('video')
            ->useDisk('public') // opcional, ajusta si uso otro disk
            ->acceptsMimeTypes(['video/mp4', 'video/webm'])
            ->singleFile(); // 1 video por neologismo (1:1)
    }

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/palabras/' . $this->getKey());
    }
}
