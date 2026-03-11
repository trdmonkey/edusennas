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

            <form class="hero-search" onsubmit="return false;">

                <div class="input-group input-group-lg">

                    <input type="text"
                    class="form-control"
                    id="busqueda"
                    placeholder="Ejemplo: hola, gracias, agua...">

                    <button class="btn btn-primary">
                        Buscar
                    </button>

                </div>

                <!-- Este es el div que muestra los resultados de las coincidencias del buscador - id:resultados -->
                <div class="search-wrapper">
                    <div id="resultados" class="search-results"></div>
                </div>

            </form>

        </div>

    </section>

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

    <script>

        /* aqui vamos a agregar la funcion para que el buscador funcione letra por letra */

        /* Vamos a intentar mostrar un video primero */
        document.addEventListener("DOMContentLoaded", function(){
            let input = document.getElementById('busqueda');
            let resultados = document.getElementById('resultados');

            input.addEventListener('keyup', function(){

                let query = this.value;
                if(query.length < 2){
                    resultados.innerHTML = '';
                    return;
                }
                fetch(`/buscar-senas?q=${query}`)
                .then(response => response.json())
                .then(data => {

                    let html = '';
                    if(data.length === 0){
                        html = `<div class="search-item">No se encontraron resultados</div>`;
                    }else{
                        data.forEach(item => {

html += `
<a href="/sena/${item.slug}" class="search-card">

<div class="search-video">

<video muted loop preload="metadata">
<source src="${item.video}" type="video/mp4">
</video>

<div class="play-icon">▶</div>

</div>

<div class="search-info">

<span class="search-title">
${item.nombre}
</span>

<span class="search-badge">
${item.categoria}
</span>

</div>

</a>
`;

                        });
                    }
                    resultados.innerHTML = html;
                });
            });
        });

        /* Esta pequeña función es para reproducir el video cuando se hace hover al card o a la imagen */
        
        /* aqui ponemos a rodar el video (SIN AUDIO) y de forma automatica al poner el cursor sobre la imagen */
        document.addEventListener("mouseover", function(e){
            if(e.target.tagName === "VIDEO"){
                e.target.play();
            }
        });

        /* Esta pausa el video automatico despues de quitar el cursor del video, y tambien el onBlur */
        document.addEventListener("mouseout", function(e){
            if(e.target.tagName === "VIDEO"){
                e.target.pause();
            }
        });

    </script>

@endsection

