<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function posts()
    {
        return view('posts', [
            // Cargamos a los posts y usuarios de forma descendente
            'posts' => Post::with('user')->latest()->paginate()
        ]);
    }

    public function post(Post $post) // La variable $post debe coincidir con el parámetro en la ruta '/blog{post}'
    {
        return view('post', [
            'post' => $post
        ]);
    }
}
