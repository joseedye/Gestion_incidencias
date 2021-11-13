@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif

            <div class="card border-success mb-3">
                <div class="card-header text-white bg-success" style="padding-bottom: 0%">
                    <h4 class="card-title">Incidencias reportadas por mí</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Categoría</th>
                                <th>Severidad</th>
                                <th>Estado</th>
                                <th>Fecha creación</th>
                                <th>Título</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody id="dashboard_by_me">
                            @foreach ($incidents as $key =>$incident)
                                <tr>
                                    <td> N{{$key+1}}</td>
                                    <td>{{ $incident->category_name }}</td>
                                    <td>{{ $incident->severity_full }}</td>
                                    <td>{{ $incident->state }}</td>
                                    <td>{{ $incident->created_at }}</td>
                                    <td>{{ $incident->title_short }}</td>
                                    <td>
                                        <a href="/ver/{{ $incident->id }}" class="btn btn-info btn-sm">
                                            Ver
                                        </a>
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
