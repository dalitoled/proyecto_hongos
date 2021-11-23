<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;

class TutorialController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-tutorial|crear-tutorial|editar-tutorial|borrar-tutorial')->only('index');
         $this->middleware('permission:crear-tutorial', ['only' => ['create','store']]);
         $this->middleware('permission:editar-tutorial', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-tutorial', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Con paginación
        $tutoriales = Tutorial::paginate(5);
        return view('tutoriales.index',compact('tutoriales'));
        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $tutoriales->links() !!}    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tutoriales.crear');
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
    
        Tutorial::create($request->all());
    
        return redirect()->route('tutoriales.index');
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
    public function edit(Tutorial $receta)
    {
        return view('tutoriales.editar',compact('receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutorial $receta)
    {
         request()->validate([
            'titulo' => 'required',
            'contenido' => 'required',
        ]);
    
        $receta->update($request->all());
    
        return redirect()->route('tutoriales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutorial $receta)
    {
        $receta->delete();
    
        return redirect()->route('tutoriales.index');
    }
}
