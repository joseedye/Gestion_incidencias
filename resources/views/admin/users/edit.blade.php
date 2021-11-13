@extends('layouts.app')

@section('content')
           <div class="card border-primary">
                <div class="card-header text-white bg-primary">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if (session('notification'))
                        <div class="alert alert-success">
                        {{session('notification')}}
                        </div>
                     @endif

                    @if (count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action=" " method="POST">
                        @csrf
                        @method('put')
                        
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" readonly value="{{old('email',$user->email)}}">
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{old('name', $user->name)}}">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña<em> Ingresar solo si desea modificar</em></label>
                            <input type="text" name="password" class="form-control" value="{{old('password')}}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Guardar Usuario </button>
                        </div>
                    </form>
                    <form action="/proyecto-usuario" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="project_id" class="form-control" id="select-project">
                                    <option value="">Seleccionar Proyecto</option>
                                    @foreach ($projects as $project)
                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="level_id" class="form-control" id="select-level">                                    
                                    <option value="">Seleccionar Nivel</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-block">Asignar Proyecto</button>
                            </div>
                        </div>
                    </form>
                    

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Proyecto</th>
                                <th>Nivel</th>
                                <th>Opciones</th>
                            </tr>    
                        </thead>
                        <tbody>
                            @foreach ($projects_user as $project_user) 
                            <tr>
                                <td>{{$project_user->project->name}}</td>
                                <td>{{$project_user->level->name}}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                          </svg> 
                                    </a>
                                    <a href="/proyecto-usuario/{{$project_user->id}}/eliminar" class="btn btn-sm btn-danger" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                          </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
       
@endsection

@section('scripts')
    <script src="/js/admin/users/edit.js"></script>
@endsection