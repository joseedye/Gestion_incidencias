@extends('layouts.app')

@section('content')

<div class="card border-primary">
    <div class="card-header text-white bg-primary">{{ __('Dashboard') }}</div>
    <div class="card-body">
        @if (auth()->user()->is_Support)
        <div class="card border-success mb-3">
            <div class="card-header text-white bg-success" style="padding-bottom: 0%">
                <h4 class="card-title">Incidencias asignadas a mí</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Severidad</th>
                            <th>Estado</th>
                            <th>Fecha creación</th>
                            <th>Título</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_my_incidents">
                        @foreach ($my_incidents as $incident)
                            <tr>
                                <td>
                                    <a href="/ver/{{ $incident->id }}">
                                        {{ $incident->id }}
                                    </a>
                                </td>
                                <td>{{ $incident->category_name }}</td>
                                <td>{{ $incident->severity_full }}</td>
                                <td>{{ $incident->state }}</td>
                                <td>{{ $incident->created_at }}</td>
                                <td>{{ $incident->title_short }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="card border-success mb-3">
            <div class="card-header text-white bg-success" style="padding-bottom: 0%">
                <h4 class="card-title">Incidencias sin asignar</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Severidad</th>
                            <th>Estado</th>
                            <th>Fecha creación</th>
                            <th>Título</th>
                            <th>Opción</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_pending_incidents">
                        @foreach ($pending_incidents as $incident)
                            <tr>
                                <td>
                                    <a href="/ver/{{ $incident->id }}">
                                        {{ $incident->id }}
                                    </a>
                                </td>
                                <td>{{ $incident->category_name }}</td>
                                <td>{{ $incident->severity_full }}</td>
                                <td>{{ $incident->state }}</td>
                                <td>{{ $incident->created_at }}</td>
                                <td>{{ $incident->title_short }}</td>
                                <td>
                                    <a href="/incidencia/{{ $incident->id }}/atender" class="btn btn-primary btn-sm">
                                        Atender
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div> 
             
        @endif
        
        <div class="card border-success mb-3">
            <div class="card-header text-white bg-success" style="padding-bottom: 0%">
                <h4 class="card-title">Incidencias reportadas por mí</h4>
            </div>
            <div class="card-body">
                @if (session('notification'))
                        <div class="alert alert-danger">
                           {{session('notification')}}
                        </div>
                    @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Severidad</th>
                            <th>Estado</th>
                            <th>Fecha creación</th>
                            <th>Título</th>
                            <th>Opción</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_by_me">
                        @foreach ($incidents_by_me as $incident)
                            <tr>
                                <td>
                                    <a href="/ver/{{ $incident->id }}">
                                        {{ $incident->id }}
                                    </a>
                                </td>
                                <td>{{ $incident->category_name }}</td>
                                <td>{{ $incident->severity_full }}</td>
                                <td>{{ $incident->state }}</td>
                                <td>{{ $incident->created_at }}</td>
                                <td>{{ $incident->title_short }}</td>
                                <td>
                                    @if ($incident->active!=0)
                                    <a href="/incidencia/{{ $incident->id }}/eliminar" class="btn btn-danger btn-sm">
                                        Eliminar</a>
                                    @else
                                    <a href="/ver/{{ $incident->id }}" class="btn btn-info btn-sm">
                                        Ver</a>
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
@endsection