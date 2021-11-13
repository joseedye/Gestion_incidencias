@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
           <div class="card ">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action=" " method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select name="category_id"  class="form-control">
                                <option value="">General </option>
                                @foreach ($categories as $category)
                                <option value={{$category->id}}>{{$category->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="severity">Severidad</label>
                            <select name="severity" class="form-control">
                                <option value="M">Menor </option>
                                <option value="N">Normal </option>
                                <option value="A">Alta </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea name="descripcion" class="form-control">{{old('descripcion')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="anexo">Anexo</label>
                            {{-- <input type="file" name="file[]" class="form-control" accept="image/*" multiple="">                             --}}
                            <input type="file" name="file" class="form-control" accept="image/*">                            
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary">Registrar Incidente </button>
                        </div>
                    </form>
                </div>
            </div>
       
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
