@extends('brackets/admin-ui::admin.layout.default')
@section('title', 'Dashboard - InSign')

@section('body')
    <div class="container-xl">
        <div class="main-content">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body pb-0">
                            <div class="text-value h1">{{ $wordsCount }}</div>
                            <div>Palabras Registradas</div>
                        </div>
                        <div class="chart-wrapper mt-3" style="height:70px;">
                             <i class="fa fa-book fa-3x float-right mr-3" style="opacity: 0.3"></i>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card text-white bg-info">
                        <div class="card-body pb-0">
                            <div class="text-value h1">{{ $categoriesCount }}</div>
                            <div>Categorías Activas</div>
                        </div>
                        <div class="chart-wrapper mt-3" style="height:70px;">
                             <i class="fa fa-tags fa-3x float-right mr-3" style="opacity: 0.3"></i>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body pb-0">
                            <div class="text-value h1">{{ $usersCount }}</div>
                            <div>Administradores</div>
                        </div>
                        <div class="chart-wrapper mt-3" style="height:70px;">
                             <i class="fa fa-users fa-3x float-right mr-3" style="opacity: 0.3"></i>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="mb-3">Gestión Prioritaria</h4>
                    <div class="card-group shadow-sm">
                        <div class="card text-center p-3 border-right">
                            <div class="text-muted small text-uppercase font-weight-bold">Acción Rápida</div>
                            <div class="mt-2">
                                <a href="{{ url('admin/palabras/create') }}" class="btn btn-outline-primary btn-sm text-dark font-weight-bold">Nueva Seña</a>
                            </div>
                        </div>
                        <div class="card text-center p-3 border-right">
                            <div class="text-muted small text-uppercase font-weight-bold">Base de Datos</div>
                            <div class="text-value-sm mt-2">Optimizado <i class="fa fa-check-circle text-success"></i></div>
                        </div>
                        <div class="card text-center p-3">
                            <div class="text-muted small text-uppercase font-weight-bold">Último Backup</div>
                            <div class="text-value-sm mt-2">Hace 14 horas</div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-history"></i> Últimas señas agregadas
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Palabra</th>
                                        <th>Categoría</th>
                                        <th>Fecha</th>
                                        <th class="text-center">Estado</th> {{-- Nueva columna --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestWords as $word)
                                    <tr>
                                        <td>{{ $word->nombre }}</td>
                                        <td><span class="badge badge-primary">{{ $word->categoria->nombre ?? 'Sin Categoría' }}</span></td>
                                        <td>{{ $word->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if($word->estado)
                                                <span class="badge badge-success">Activo</span>
                                            @else
                                                <span class="badge badge-danger">Inactivo</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-pie-chart"></i> Distribución por Categoría
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach($categoriesStats as $cat)
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between">
                                                <strong>{{ $cat->nombre }}</strong>
                                                <span>{{ $cat->palabras_count }} señas</span>
                                            </div>
                                            <div class="progress progress-xs mt-2">
                                                <div class="progress-bar bg-info" style="width: {{ ($cat->palabras_count / ($wordsCount ?: 1)) * 100 }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="col-md-6">
                                    <div style="max-height: 250px;">
                                        <canvas id="categoryChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection

@section('bottom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // aqui ussamos un pequeño timeout para asegurar que el DOM y el canvas existan
        setTimeout(function() {
            const ctx = document.getElementById('categoryChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($categoriesStats->pluck('nombre')) !!},
                        datasets: [{
                            label: 'Palabras por Categoría',
                            data: {!! json_encode($categoriesStats->pluck('palabras_count')) !!},
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true
                    }
                });
            }
        }, 500);
    </script>


@endsection