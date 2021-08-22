@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        {{-- Colocando archivo multimedia --}}
                        @if ($post->image)
                            <img src="{{ $post->get_image }}" class="card-img-top">
                        @elseif ($post->iframe)
                            {{-- Para imprimir código html --}}
                            <div class="embed-responsive embed-responsive-16by9">
                                {!! $post->iframe !!}
                            </div>
                        @endif
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            {{ $post->get_excerpt }}
                            <a href="{{ route('post', $post) }}">Leer más</a>
                        </p>
                        <p class="text-muted mb-0">
                            <em>
                                &ndash; {{ $post->user->name }}
                            </em>
                            {{ $post->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
            {{-- Imprimir datos de paginación --}}
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection