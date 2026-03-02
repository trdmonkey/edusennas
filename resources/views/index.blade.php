@extends('master')

@section('header')
    @include('layout.partials.header')
@endsection
@yield('body')
@section('content')

    <div class="app-body">

        <main class="main">
                
            <div class="card-group">
        
                @forelse ($categorias as $categoria)
                <div class="card">
                    @if ($categoria->getFirstMediaUrl('imagen'))
                        <img src="{{ $categoria->getFirstMediaUrl('imagen') }}"
                            alt="{{ $categoria->nombre }}"
                            style="height:200px;object-fit:cover;">
                    @else
                        <img src="{{ asset('images/senas_logo__2.png') }}"
                            alt="Sin imagen"
                            style="height:200px;object-fit:cover;">
                    @endif
                    <div class="card-body">
                    <h5 class="card-title">{{ $categoria->nombre }}</h5>
                    <p class="card-text">{{ $categoria->descripcion }}</p>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
                </div> 
  
                @empty
                    <p>No tiene categorias</p>
                @endforelse
  
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