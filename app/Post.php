<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

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
}
