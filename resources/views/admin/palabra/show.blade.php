@extends('brackets/admin-ui::admin.layout.default')

@section('title', 'Ver palabra')

@section('body')

<div class="container-xl">

    <div class="card shadow-sm">

        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center">
                <i class="text-primary mr-2" style="font-size: 30px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="40" height="40" fill="#0d6efd" style="opacity:1;"><rect width="2.8" height="12" x="1" y="6" ><animate attributeName="y" begin="SVGKWB9Ob0W.begin+0.4s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="6;1;6"/><animate attributeName="height" begin="SVGKWB9Ob0W.begin+0.4s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="12;22;12"/></rect><rect width="2.8" height="12" x="5.8" y="6" ><animate attributeName="y" begin="SVGKWB9Ob0W.begin+0.2s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="6;1;6"/><animate attributeName="height" begin="SVGKWB9Ob0W.begin+0.2s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="12;22;12"/></rect><rect width="2.8" height="12" x="10.6" y="6" ><animate id="SVGKWB9Ob0W" attributeName="y" begin="0;SVGCkSt6baQ.end-0.1s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="6;1;6"/><animate attributeName="height" begin="0;SVGCkSt6baQ.end-0.1s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="12;22;12"/></rect><rect width="2.8" height="12" x="15.4" y="6" ><animate attributeName="y" begin="SVGKWB9Ob0W.begin+0.2s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="6;1;6"/><animate attributeName="height" begin="SVGKWB9Ob0W.begin+0.2s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="12;22;12"/></rect><rect width="2.8" height="12" x="20.2" y="6" ><animate id="SVGCkSt6baQ" attributeName="y" begin="SVGKWB9Ob0W.begin+0.4s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="6;1;6"/><animate attributeName="height" begin="SVGKWB9Ob0W.begin+0.4s" calcMode="spline" dur="0.6s" keySplines=".14,.73,.34,1;.65,.26,.82,.45" values="12;22;12"/></rect></svg>
                </i>
                <!-- https://www.shadcn.io/icons/ant-design -->    
                <div>
                    <div class="font-weight-semibold">
                        Detalle de la palabra
                    </div>
                    <small class="text-muted">
                        {{ $palabra->nombre }}
                    </small>
                </div>
            </div>

            <a href="{{ url('admin/palabras') }}" class="btn btn-sm btn-primary">
                <i class="icon-action-undo mr-1"></i>
                Volver
            </a>

        </div>

        <div class="card-body">

            {{-- VIDEO --}}
            @php
                $media = $palabra->getFirstMedia('video');
            @endphp

            <div class="mb-4">
                <h6 class="text-muted mb-2">Video en Lengua de Señas</h6>

                @if($media)
                    <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm bg-dark">
                        <video
                            controls
                            preload="metadata"
                            playsinline
                            style="width:100%; height:100%; background:#000;"
                        >
                            <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                            Tu navegador no soporta reproducción de video.
                        </video>
                    </div>
                @else
                    <div class="border rounded p-4 text-center text-muted bg-light">
                        📹 No hay video asociado a esta palabra
                    </div>
                @endif
            </div>

            {{-- INFO --}}
            <div class="row g-4">

                <div class="col-md-8">
                    <div class="border rounded p-3 h-100">
                        <h6 class="text-muted mb-3">Información general</h6>

                        <dl class="mb-0">
                            <dt>Nombre</dt>
                            <dd>{{ $palabra->nombre }}</dd>

                            <dt>Slug</dt>
                            <dd><code>{{ $palabra->slug }}</code></dd>

                            <dt>Categoría</dt>
                            <dd>{{ optional($palabra->categoria)->nombre ?? '—' }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="border rounded p-3 h-100 text-center">
                        <h6 class="text-muted mb-3">Estado</h6>

                        @if($palabra->estado)
                            <span class="badge badge-success px-3 py-2">
                                <i class="text-primary mr-2" style="font-size: 20px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" width="20" height="20" fill="#000000" style="opacity:1;"><path  d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64m0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372"/><path  fill-opacity=".15" d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372s372-166.6 372-372s-166.6-372-372-372m193.4 225.7l-210.6 292a31.8 31.8 0 0 1-51.7 0L318.5 484.9c-3.8-5.3 0-12.7 6.5-12.7h46.9c10.3 0 19.9 5 25.9 13.3l71.2 98.8l157.2-218c6-8.4 15.7-13.3 25.9-13.3H699c6.5 0 10.3 7.4 6.4 12.7"/><path  d="M699 353h-46.9c-10.2 0-19.9 4.9-25.9 13.3L469 584.3l-71.2-98.8c-6-8.3-15.6-13.3-25.9-13.3H325c-6.5 0-10.3 7.4-6.5 12.7l124.6 172.8a31.8 31.8 0 0 0 51.7 0l210.6-292c3.9-5.3.1-12.7-6.4-12.7"/></svg>
                                </i> Activo
                            </span>
                        @else
                            <span class="badge badge-danger px-3 py-2">
                                <i class="text-primary mr-2" style="font-size: 20px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#ffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="opacity:1;"><path  d="M15 15L9 9m6 0l-6 6"/><circle cx="12" cy="12" r="10"/></svg>
                                </i> Inactivo
                            </span>
                        @endif
                    </div>
                </div>

            </div>

            {{-- DESCRIPCIÓN --}}
            @if($palabra->descripcion)
                <div class="mt-4">
                    <h6 class="text-muted mb-2">Descripción</h6>
                    <div class="border rounded p-3 bg-light">
                        {{ $palabra->descripcion }}
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>

@endsection
