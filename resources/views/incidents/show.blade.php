@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="card ">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success">
                    {{ session('notification') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Proyecto</th>
                        <th>Categoría</th>
                        <th>Fecha de envío</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="incident_key">{{ $incident->id }}</td>
                        <td id="incident_project">{{ $incident->project->name }}</td>
                        <td id="incident_category">{{ $incident->category_name }}</td>
                        <td id="incident_created_at">{{ $incident->created_at }}</td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>Asignada a</th>
                        <th>Nivel</th>
                        <th>Estado</th>
                        <th>Severidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="incident_responsible">{{ $incident->support_name }}</td>
                        <td>{{$incident->level->name}}</td>
                        <td id="incident_state">{{ $incident->state }}</td>
                        <td id="incident_severity">{{ $incident->severity_full }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Título</th>
                        <td id="incident_summary">{{ $incident->title }}</td>
                    </tr>
                    <tr>
                        <th>Descripción</th>
                        <td id="incident_description">{{ $incident->descripcion }}</td>
                    </tr>
                    <tr>
                        <th>Adjuntos</th>
                        <td id="incident_attachment">                        
                            <a type="button" href="{{Route('file.download', $incident->url)}}">Descargar</a>                            
                        </td>                      
                    </tr>
                </tbody>
            </table> 
            {{-- <div>
                <h4>Agregar Anexos</h4>
                <form action=""
                    method="POST"
                    class="dropzone"
                    id="my-awesome-dropzone">
                </form>
            </div> --}}
            
            @if ($incident->support_id == null && $incident->active && auth()->user()->role==1)

            <a href="/incidencia/{{ $incident->id }}/atender"class="btn btn-primary btn-sm" id="incident_btn_apply">Atender Incidendia</a>
            
            @endif
            @if ($incident->support_id == auth()->user()->id && $incident->active)

            <a href="/incidencia/{{ $incident->id }}/desistir"class="btn btn-warning btn-sm" id="incident_btn_apply">Desistir Incidendia</a>
            
            @endif

            @if (auth()->user()->id == $incident->support_id && $incident->active==0)

                <a href="/incidencia/{{ $incident->id }}/abrir" class="btn btn-info btn-sm" id="incident_btn_open">Volver abrir incidencia</a>
            
            @endif

            {{-- @if (auth()->user()->id==$incident->client->id)

                @if ($incident->active)
                <a href="/incidencia/{{ $incident->id }}/resolver" class="btn btn-info btn-sm" id="incident_btn_solve">Marcar como resuelto</a>
                {{-- @else
                <a href="/incidencia/{{ $incident->id }}/abrir" class="btn btn-info btn-sm" id="incident_btn_open">Volver abrir incidencia</a> --}}
                {{-- @endif             --}}
            
            {{-- @endif  --}}
            
            
            {{-- <a href="/incidencia/{{ $incident->id }}/editar" class="btn btn-success btn-sm" id="incident_btn_edit">Editar Incidencia</a> --}}

            @if (auth()->user()->id == $incident->support_id && $incident->active)

            <a href="/incidencia/{{ $incident->id }}/derivar" class="btn btn-danger btn-sm" id="inicident_btn_derive">Derivar al siguiente nivel</a>
            <a href="/incidencia/{{ $incident->id }}/resolver" class="btn btn-info btn-sm" id="incident_btn_solve">Marcar como resuelto</a>  
            @endif
            
            
        </div>
    </div>
       @include('layouts.chat')
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    Dropzone.options.myAwesomeDropzone ={
        headers:{
            'X-CSRF-TOKEN' : "{{csrf_token()}}"
        },
        dictDefaultMessage: "Arrastre una imagen al recuadro para subirlo",
        acceptedFiles: "image/*",
        maxFilesize: 2,
        maxFiles:4,
    }
</script>
@endsection