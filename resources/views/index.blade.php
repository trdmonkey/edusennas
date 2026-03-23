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

<section class="categorias-highlight">

    <h2 class="titulo-animado">
        Aprende Lenguaje de Señas Fácilmente
    </h2>

</section>



<div class="slider-container">

    <div class="slider-track" id="sliderTrack">

        @foreach ($categorias as $categoria)
            <div class="slide categoria-slide">

                <div class="card-pro">

                    <img src="{{ $categoria->getFirstMediaUrl('imagen') ?: asset('images/Logo__vertical.png') }}">

                    <h3>{{ $categoria->nombre }}</h3>

                </div>

            </div>
        @endforeach

        <!-- DUPLICADO PARA LOOP INFINITO -->
        @foreach ($categorias as $categoria)
            <div class="slide categoria-slide">

                <div class="card-pro">

                    <img src="{{ $categoria->getFirstMediaUrl('imagen') ?: asset('images/Logo__vertical.png') }}">

                    <h3>{{ $categoria->nombre }}</h3>

                </div>

            </div>
        @endforeach

    </div>

</div>


@endsection

@section('footer')
    @include('layout.partials.footer')
@endsection

@section('bottom-scripts')
    @parent

<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

<!-- CDN de ScrollTrigger para animar las cards de las categorias -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

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


        /* ANIMACIONES CON GSAP */

        // HERO (logo + fondo)
        gsap.from(".hero-anim", {
            opacity: 0,
            scale: 1.05,
            duration: 1.2,
            ease: "power2.out"
        });

        // BUSCADOR (entrada flotante)
        gsap.from(".search-anim", {
            y: 80,
            opacity: 0,
            duration: 1,
            delay: 0.3,
            ease: "power3.out"
        });

        // CARDS (cascada)
        gsap.from(".card-anim", {
            y: 50,
            opacity: 0,
            duration: 0.8,
            stagger: 0.1,
            delay: 0.6,
            ease: "power2.out"
        });

        // NAVBAR
        gsap.from(".nav-anim", {
            y: -60,
            opacity: 0,
            duration: 0.8,
            ease: "power2.out"
        });

        gsap.registerPlugin(ScrollTrigger);

        // vamos a agregar una clase "active" a la card que esté más cerca del centro de la pantalla, para darle un efecto de zoom o resalte
        const slides = document.querySelectorAll(".categoria-slide");
        function updateCenter() {
            let center = window.innerWidth / 2;

            slides.forEach(slide => {
                let rect = slide.getBoundingClientRect();
                let slideCenter = rect.left + rect.width / 2;

                if (Math.abs(center - slideCenter) < 150) {
                    slide.classList.add("active");
                } else {
                    slide.classList.remove("active");
                }
            });
        }

        // actualizar constantemente
        gsap.ticker.add(updateCenter);        


    });

    // SLIDER INFINITO
    document.addEventListener("DOMContentLoaded", () => {

        const track = document.getElementById("sliderTrack");
        const totalWidth = track.scrollWidth / 2;
        gsap.to(track, {
            x: -totalWidth,
            duration: 20,
            ease: "none",
            repeat: -1
        });

        gsap.from(".titulo-animado", {
            opacity: 0,
            y: 80,
            duration: 1.2,
            ease: "power3.out"
        });

    });
    track.addEventListener("mouseenter", () => gsap.globalTimeline.pause());
    track.addEventListener("mouseleave", () => gsap.globalTimeline.resume());

</script>

@endsection

