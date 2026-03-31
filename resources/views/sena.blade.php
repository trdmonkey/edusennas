@extends('master')

@section('content')

<div class="sena-container">


    <div class="sena-card">
            <div class="back-button">
        <a href="{{ url()->previous() }}">
            <i class="fas fa-arrow-left"></i>
            Volver
        </a>
    </div>
        <h2 class="sena-title">
            {{ $palabra->nombre }}
        </h2>

        @if($palabra->getFirstMediaUrl('video'))

        <div class="video-wrapper-pro">
            <video controls>
                <source src="{{ $palabra->getFirstMediaUrl('video') }}" type="video/mp4">
            </video>
        </div>

        @endif

        <div class="sena-actions">

            <button><i class="fas fa-heart"></i></button>
            <button><i class="fas fa-share-alt"></i></button>
            <button><i class="fas fa-bookmark"></i></button>

        </div>

        <p class="sena-desc">
            {{ $palabra->descripcion }}
        </p>

        <div class="sena-meta">

            <span>
                <i class="fas fa-folder"></i>
                {{ $palabra->categoria->nombre ?? 'General' }}
            </span>

            <span>
                <i class="fas fa-play-circle"></i>
                Video educativo
            </span>

        </div>

    </div>

</div>

@endsection