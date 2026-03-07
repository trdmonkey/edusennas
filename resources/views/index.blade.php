@extends('master')

@section('header')
    @include('layout.partials.header')
@endsection
@yield('body')
@section('content')

    <!-- HERO BUSQUEDA -->

    <section class="hero-busqueda">

        <div class="container text-center">

            <h1 class="hero-title">
                Aprende Lenguaje de Señas Fácilmente
            </h1>

            <p class="hero-subtitle">
                Busca cualquier palabra y mira cómo se dice en lenguaje de señas
            </p>

            <form class="hero-search">

                <div class="input-group input-group-lg">

                    <input type="text"
                    class="form-control"
                    id="busqueda"
                    placeholder="Ejemplo: hola, gracias, agua...">

                    <button class="btn btn-primary">
                    Buscar
                    </button>

                </div>

            </form>

        </div>

    </section>

    <div class="app-body">

        <main class="main">

            <div id="resultados" class="search-results"></div>
                
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

    <script>

        document.getElementById('busqueda').addEventListener('keyup', function(){

            let query = this.value;

            if(query.length < 2){
                document.getElementById('resultados').innerHTML = '';
                return;
            }

            fetch(`/buscar-senas?q=${query}`)

            .then(response => response.json())

            .then(data => {

                let html = '';

                data.forEach(item => {

                    html += `
                    <div class="search-item">
                    ${item.nombre}
                    </div>
                    `;

                });

                document.getElementById('resultados').innerHTML = html;

            });

        });

    </script>

@endsection

