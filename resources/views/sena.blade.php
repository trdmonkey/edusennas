@extends('master')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8 text-center">

            <h2 class="mb-4">
                {{ $palabra->nombre }}
            </h2>

            @if($palabra->getFirstMediaUrl('video'))

            <video controls width="100%">
                <source src="{{ $palabra->getFirstMediaUrl('video') }}" type="video/mp4">
            </video>

            @endif

            <p class="mt-4">
                {{ $palabra->descripcion }}
            </p>

            <p class="text-muted">
                Categoría: {{ $palabra->categoria->nombre ?? 'General' }}
            </p>

        </div>

    </div>

</div>

@endsection