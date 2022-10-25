@extends('layouts.app')

@section('content')



<div class="container">


    <h3> {{$modo}} Series</h3>
    
    @if(count($errors)>0)

        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>  
    @endif


    <br>
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ isset($serie->nombre)?$serie->nombre:old('nombre')}}">
    </div>

    <div class="form-group">
        <label for="duracion">Duracion</label>
        <input type="text" class="form-control" name="duracion" id="duracion" value="{{isset($serie->duracion)?$serie->duracion:old('duracion')}}">
    </div>

    <div class="form-group">
        <label for="director">Director</label>
        <input type="text" class="form-control" name="director" id="director" value="{{isset($serie->director)?$serie->director:old('director') }}">
    </div>

    <div class="form-group">
        <label for="imagen"></label>
    <!--
        { {$serie->imagen} }
        muestra la ruta de la imagen
     -->

        @if(isset($serie->imagen))
        <img src="{{asset('storage').'/'.$serie->imagen }}" class="img-thumbnail img-fluid" width="100" alt="">
        @endif

        <input type="file" class="form-control" name="imagen" id="imagen" value="">
    </div>
    <br>
    <input type="submit" class="btn btn-success" value="{{$modo}}" >
    <a class="btn btn-secondary" href="{{url('series/')}}">Atras</a>
@endsection
</div>