
<form action="{{url('/series/'.$serie->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}

    @include('series.form',['modo'=>'Editar'])
</form>

