<form action="{{url('/series')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('series.form',['modo'=>'Agregar'])
    
</form>