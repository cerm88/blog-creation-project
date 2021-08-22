<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'body', 'iframe', 'image', 'user_id',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    // Retornamos la función adecuada para la relación
    public function user()
    {
        return $this->belongsTo(User::class); // Un post pertenece a un usuario
    }

    // Estracto del post
    public function getGetExcerptAttribute()
    {
        return substr($this->body, 0, 140);
    }

    // Método para importar la imagen en la vista
    public function getGetImageAttribute()
    {
        if ($this->image) {
            // Debemos hacer pública la carpeta storage/ con accedo directo a public mediante `php artisan storage:link`
            return url("storage/$this->image");
        }
    }
}
