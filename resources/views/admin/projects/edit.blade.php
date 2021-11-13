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
                    <form action="" method="POST">
                        @method('PUT')
                        @csrf
                                                
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{old('name',$project->name)}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <input type="text" name="description" class="form-control" value="{{old('description', $project->descripcion)}}">
                        </div>
                        <div class="form-group">
                            <label for="fechaInicio">Fecha inicio</label>
                            <input type="date" name="fechaInicio" class="form-control" value="{{old('fechaInicio',$project->start)}}">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">Actualizar Projecto </button>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Categorias</p>
                            <form action="/categorias" method="POST" class="form-inline">
                                @csrf
                                <input type="hidden" name="project_id"  value="{{$project->id}}">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Ingrese nombre" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Añadir</button>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Opciones</th>
                                    </tr>    
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)    
                                    <tr>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" title="Editar" data-category="{{$category->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg> 
                                            </button>
                                            <a href="/categoria/{{$category->id}}/eliminar" type="button" class="btn btn-sm btn-danger" title="Eliminar">
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

                        <div class="col-md-6">
                            <p>Niveles</p>
                            <form action="/niveles" method="POST" class="form-inline">
                                @csrf
                                <input type="hidden" name="project_id" value="{{$project->id}}">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Ingrese nombre" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Añadir</button>
                                </div>
                            </form>
                            <form action="/niveles" method="POST"></form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nivel</th>
                                        <th>Opciones</th>
                                    </tr>    
                                </thead>
                                <tbody>
                                    @foreach ($levels as $key => $level) 
                                    <tr>
                                        <td>N{{$key+1}}</td>
                                        <td>{{$level->name}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" title="Editar" data-level="{{$level->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg> 
                                            </button>
                                            <a href="/nivel/{{$level->id}}/eliminar" type="button" class="btn btn-sm btn-danger" title="Eliminar">
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
                    
                </div>
         </div>
       

          <div class="modal" tabindex="-1" id="modalEditCategory">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Editar Categoria</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/categoria/editar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                    
                        <input type="hidden" name="category_id" id="category_id" value="">
                        <div class="form-group">
                            <label for="name">Nombre de la categoría</label>
                            <input type="text" class="form-control" name="name" id="category_name" value="">
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
              </div>
            </div>
            </div>

          <div class="modal" tabindex="-1" id="modalEditLevel">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Editar Nivel</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="/nivel/editar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                    
                        <input type="hidden" name="level_id" id="level_id" value="">
                        <div class="form-group">
                            <label for="name">Nombre del nivel</label>
                            <input type="text" class="form-control" name="name" id="level_name" value="">
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
              </div>
            </div>
          </div>



 
@endsection

@section('scripts')
    <script src="/js/admin/projects/edit.js"></script>
@endsection