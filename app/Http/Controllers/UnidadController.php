<?php

namespace App\Http\Controllers;

use App\UnidadModel;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UnidadModel $unidadModel){
       
        if($request->ajax()){
            $unidades = $unidadModel -> where('eliminar', false) -> paginate('7');
            $html = view('pages.unidades.lista', compact('unidades'))->render();
            
            return response()->json(['html' => $html]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

        if($request->ajax()){
            $html = view('pages.unidades.form')->render();  
            
            return response()->json(['html'=>$html]); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadModel $unidad){
        
        $unidad -> create([
            'descripcion' => request('nombre'),
            'abreviatura' => request('abrev'),
            'eliminar' => false
        ]);

        return redirect()->route('init.productos')->with('alert', 'true');
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
    public function edit($id){
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnidadModel $unidadModel){

        if($request->ajax()){

            $unidad = $unidadModel->find(request('id'));
            $unidad -> update([
                'descripcion' => request('nombre'),
                'abreviatura' => request('abrev'),
                'eliminar' => false    
            ]);

            $unidades = $unidadModel -> where('eliminar', false) -> paginate('7');

            $html = view('pages.unidades.lista', compact('unidades'))->render();  
            
            return response()->json(['html'=>$html, 'unit'=>$unidades]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UnidadModel $unidadModel){

        if($request->ajax()){

            $unidad = $unidadModel->find(request('id'));
            $unidad -> update([
                'eliminar' => true    
            ]);

            $unidades = $unidadModel -> where('eliminar', false) -> paginate('7');

            $html = view('pages.unidades.lista', compact('unidades'))->render();  
            
            return response()->json(['html'=>$html]); 
        }
    }
}