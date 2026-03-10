<header class="app-header">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

<div class="container-fluid">

    <!-- LOGO -->
    <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('images/logo_senas_bg_transparent.png') }}"
             alt="logo"
             style="height:40px;margin-right:10px;">
        <!-- <span class="fw-bold">Señas Que Unen</span> -->
    </a>


    <!-- BOTON MOVIL -->
    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMain"
            aria-controls="navbarMain"
            aria-expanded="false"
            aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>

    </button>


    <div class="collapse navbar-collapse" id="navbarMain">

        <!-- MENU IZQUIERDA -->
        <ul class="navbar-nav me-auto">

            <li class="nav-item">
                <a class="nav-link active" href="/">Inicio</a>
            </li>


            <!-- CATEGORIAS -->
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle"
                   href="#"
                   role="button"
                   data-bs-toggle="dropdown">

                   Categorías
                </a>

                <ul class="dropdown-menu">

                    @forelse ($categorias as $categoria)

                        <li>
                            <a class="dropdown-item"
                               href="{{ url('categoria/'.$categoria->id) }}">
                                {{ $categoria->nombre }}
                            </a>
                        </li>

                    @empty
                        <li>
                            <span class="dropdown-item text-muted">
                                No hay categorías
                            </span>
                        </li>
                    @endforelse

                </ul>

            </li>

        </ul>


        <!-- BUSCADOR -->
        <form class="d-flex me-3" role="search">

            <input class="form-control me-2"
                   type="search"
                   placeholder="Buscar señas..."
                   aria-label="Search">

            <button class="btn btn-light" type="submit">
                Buscar
            </button>

        </form>


        <!-- LOGIN -->
        <ul class="navbar-nav">

            <li class="nav-item">
                <!-- provisional porque al final vamos a subir a un hosting -->
                <a class="nav-link" href="http://127.0.0.1:8000/admin/login">Login</a>
            </li>

        </ul>

    </div>

</div>

</nav>

</header>