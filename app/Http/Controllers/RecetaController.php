<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;


class RecetaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-receta|crear-receta|editar-receta|borrar-receta')->only('index');
         $this->middleware('permission:crear-receta', ['only' => ['create','store']]);
         $this->middleware('permission:editar-receta', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-receta', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Con paginación
        $recetas = Receta::paginate(5);
        return view('recetas.index',compact('recetas'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $recetas->links() !!}    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recetas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'titulo' => 'required',
            'contenido' => 'required',
        ]);
    
        Receta::create($request->all());
    
        return redirect()->route('recetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        return view('recetas.editar',compact('receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
         request()->validate([
            'titulo' => 'required',
            'contenido' => 'required',
        ]);
    
        $receta->update($request->all());
    
        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $receta->delete();
    
        return redirect()->route('recetas.index');
    }
}
