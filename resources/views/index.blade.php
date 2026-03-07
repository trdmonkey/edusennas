@extends('master')

@section('header')
    @include('layout.partials.header')
@endsection
@yield('body')
@section('content')

    <div class="app-body">

        <main class="main">
                
<div class="container categorias-container">

    <div class="row g-4">

        @forelse ($categorias as $categoria)

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">

            <div class="card categoria-card h-100 shadow-sm">

                @if ($categoria->getFirstMediaUrl('imagen'))
                    <img src="{{ $categoria->getFirstMediaUrl('imagen') }}"
                         class="card-img-top"
                         alt="{{ $categoria->nombre }}">
                @else
                    <img src="{{ asset('images/senas_logo__2.png') }}"
                         class="card-img-top"
                         alt="Sin imagen">
                @endif

                <div class="card-body d-flex flex-column">

                    <h5 class="card-title">
                        {{ $categoria->nombre }}
                    </h5>

                    <p class="card-text">
                        {{ Str::limit($categoria->descripcion, 90) }}
                    </p>

                    <div class="mt-auto">

                        <a href="#"
                           class="btn btn-primary w-100">
                           Ver señas
                        </a>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">
            <div class="alert alert-info text-center">
                No hay categorías disponibles
            </div>
        </div>

        @endforelse

    </div>

</div>

        </main>
    </div>
@endsection

@section('footer')
    @include('layout.partials.footer')
@endsection

@section('bottom-scripts')
    @parent
@endsection