@extends('master')

@section('header')
    @include('layout.partials.header')
@endsection
@yield('body')
@section('content')

<!-- HERO BUSQUEDA -->
<section class="hero-busqueda hero-anim">

    <video autoplay muted loop playsinline class="hero-video">
        <source src="{{ asset('images/logo_animado__2.mp4') }}" type="video/mp4">
    </video>

    <div class="hero-overlay"></div>

<!--     <div class="container text-center hero-content">

        <h1 class="hero-title">
            Aprende Lenguaje de Señas Fácilmente
        </h1>

        <p class="hero-subtitle">
            Busca cualquier palabra y mira cómo se dice en lenguaje de señas
        </p>

    </div> -->

</section>

<section class="search-section">
    <div class="container">

        <form class="search-box search-anim" onsubmit="return false;">

            <input type="text"
                id="busqueda"
                placeholder="Buscar señas...">

            <button>
                🔍
            </button>

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

                        <div class="card categoria-card h-100 shadow-sm card-anim">

                            @if ($categoria->getFirstMediaUrl('imagen'))
                                <img src="{{ $categoria->getFirstMediaUrl('imagen') }}"
                                    class="card-img-top"
                                    alt="{{ $categoria->nombre }}">
                            @else
                                <img src="{{ asset('images/Logo__vertical.png') }}"
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

<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(){

        let input = document.getElementById('busqueda');
        let resultados = document.getElementById('resultados');

        setTimeout(() => {
            input.focus();
        }, 200);

        input.addEventListener('keyup', function(){

            let query = this.value.trim();

            if(query.length < 2){
                resultados.innerHTML = '';
                resultados.style.display = "none";
                return;
            }

            fetch(`/buscar-senas?q=${query}`)
            .then(response => response.json())
            .then(data => {

                let html = '';

                if(data.length === 0){
                    resultados.style.display = "none";
                    return;
                }

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
                                    <img src="/images/video-svgrepo-com.svg" class="icon-categoria">
                                    ${item.categoria}
                                </span>
                            </div>

                        </a>
                    `;
                });

                resultados.innerHTML = html;
                resultados.style.display = "flex"; // importante para layout horizontal
            });
        });

        // autoplay hover
        document.addEventListener("mouseover", function(e){
            if(e.target.tagName === "VIDEO"){
                e.target.play();
            }
        });

        document.addEventListener("mouseout", function(e){
            if(e.target.tagName === "VIDEO"){
                e.target.pause();
            }
        });

        /* poner el cursor en el input al cargar la app */
        /* document.addEventListener("DOMContentLoaded", function(){
            let input = document.getElementById('busqueda');

            input.focus(); // enfoque automático
        }); */




        // 🔥 HERO (logo + fondo)
        gsap.from(".hero-anim", {
            opacity: 0,
            scale: 1.05,
            duration: 1.2,
            ease: "power2.out"
        });

        // 🔍 BUSCADOR (entrada flotante)
        gsap.from(".search-anim", {
            y: 80,
            opacity: 0,
            duration: 1,
            delay: 0.3,
            ease: "power3.out"
        });

        // 🧱 CARDS (cascada)
        gsap.from(".card-anim", {
            y: 50,
            opacity: 0,
            duration: 0.8,
            stagger: 0.1,
            delay: 0.6,
            ease: "power2.out"
        });

        // 📌 NAVBAR
        gsap.from(".nav-anim", {
            y: -60,
            opacity: 0,
            duration: 0.8,
            ease: "power2.out"
        });

    });
</script>

@endsection

