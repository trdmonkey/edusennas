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
        'user_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categorium::class);
    }

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

    public function user()
    {
        // pa buscar el ID en la tabla 'users' por defecto
        /* return $this->belongsTo(User::class, 'user_id'); */
        return $this->belongsTo(AdminUser::class, 'user_id');
    }

}
