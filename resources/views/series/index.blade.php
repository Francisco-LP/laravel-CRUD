@extends('layouts.app')

@section('content')
<div class="container mt-5">

<a href="{{url('series/create')}}" class="btn btn-success">Agregar una serie</a>


<div class="table-responsive">
    <table class="table table-ligth">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre</th>
                <th scope="col">Duracion</th>
                <th scope="col">Director</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($series as $serie)
                
            
            <tr class="">
                <td scope="row">{{$serie->id}}</td>

                <td scope="row"> 
                    <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$serie->imagen }}"  width="100" alt="">
                    <!--{ {$serie->imagen}}
                    muestra la ruta de la imagen
                    -->
                </td>

                <td scope="row">{{$serie->nombre}}</td>
                <td scope="row">{{$serie->duracion}}</td>
                <td scope="row">{{$serie->director}}</td>
                <td scope="row">

                    <a href="{{url('/series/'.$serie->id.'/edit')}}" class="btn btn-warning" >Editar</a>

                    <form action="{{url('/series/'.$serie->id)}}" method="post" class="d-inline">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('Quiere borrar el registro')"  class="btn btn-danger" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
</div>
