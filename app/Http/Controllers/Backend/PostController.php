<?php
// creado con php artisan make:controller Backend/PostController --resource --model=Post
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Requests\PostRequest;

// Importamos clase para trabajar en la actualización y eliminación de un archivo
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts.index', compact('posts')); // Podemos usar compact() ya que la variable $posts tiene el mismo nombre que la llave del array
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // Salvar, gardamos el post
        $post = Post::create([
            'user_id' => auth()->user()->id
        ] + $request->all());

        // Imagen, si hay una imagen entonces actualiza el post con la imagen
        if ($request->file('file')) {
            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }

        // Retornar
        return back()->with('status', 'Creado con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // Helper de colección de datos para saber que pasa al ejecutar este método
        // dd($request->all());

        // Actualizando registro
        $post->update($request->all());

        if ($request->file('file')) {
            // Eliminar imagen
            Storage::disk('public')->delete($post->image);

            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }

        return back()->with('status', 'Actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Eliminamos la imagen
        Storage::disk('public')->delete($post->image);

        // Eliminamos el post
        $post->delete();

        // Retornamos la vista anterior con un mensaje en el estatus
        return back()->with('status', 'Eliminado con éxito');
    }
}
