<?php

namespace App\Http\Controllers;

use App\Models\series;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['series']=series::paginate(6);
        return view('series.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        

        
        //validaciones
        $campos=[
            'nombre'=>'required|string|max:100',
            'duracion'=>'required|string|max:100',
            'director'=>'required|string|max:100',
            'imagen'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        //mensajes de validaciones

        $mensaje=[
            'required'=>' :attribute es requerido',
            'imagen.required'=>'La Imagen es requerida',
        ];
        //unir la validacion con el mensaje
        $this->validate($request, $campos,$mensaje);

       



        //$datosSeries = request()->all();
        $datosSeries = request()->except('_token');
        
    
        //guardar la imagen en storage upload asi ya no es temporal
        if($request->hasFile('imagen')){
            $datosSeries['imagen']=$request->file('imagen')->store('upload','public');
        }


        Series::insert($datosSeries);

        //return response()->json($datosSeries);
        return redirect('series')->with('mensaje', 'Serie agregada');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\series  $series
     * @return \Illuminate\Http\Response
     */
    public function show(series $series)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $serie=Series::findOrFail($id);

        return view('series.edit', compact('serie'));

        //return redirect('series')->with('mesaje','Serie editada con exito');
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         //validaciones
         $campos=[
            'nombre'=>'required|string|max:100',
            'duracion'=>'required|string|max:100',
            'director'=>'required|string|max:100',
            
        ];
        //mensajes de validaciones
        
        $mensaje=[
            'required'=>':attribute es requerido',
        ];
        //imagen no es necesario adjuntar foto
        if($request->hasFile('imagen')){
            $campos=['imagen'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['imagen.required'=>'La Imagen es requerida'];
        }

        //unir la validacion con el mensaje
        $this->validate($request, $campos,$mensaje);





        //
        $datosSeries = request()->except(['_token','_method']);

        if($request->hasFile('imagen')){
            $serie=Series::findOrFail($id);
            Storage::delete('public/'.$serie->imagen);
            $datosSeries['imagen']=$request->file('imagen')->store('uploads','public');
        }

        Series::where('id','=',$id)->update($datosSeries);
        $serie=Series::findOrFail($id);
        //return view('series.edit', compact('serie'));
        return redirect('series')->with('mensaje', 'Serie Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $serie=Series::findOrFail($id);

        if(Storage::delete('public/'.$serie->imagen)){
            Series::destroy($id);
        }


        return redirect('series')->with('mensaje', 'Serie Eliminada');

    }
}
