<?php

namespace Tecnoparque\Http\Controllers;

use Illuminate\Http\Request;
use Tecnoparque\Http\Controllers\Controller;
use Tecnoparque\Http\Requests;
use Tecnoparque\Persona;
use Tecnoparque\TipoDocumento;
use Tecnoparque\TipoPersona;
use Tecnoparque\LineaTecnologica;
use Tecnoparque\Gestor;
use Tecnoparque\CentroFormacion;
use Tecnoparque\Http\Requests\PersonaCreateRequest;
use Tecnoparque\Http\Requests\PersonaUpdateRequest;
use Session;
use Redirect;
use Auth;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('infoc',['only' => 'edit']); //destroy no tiene dirección
        $this->middleware('practicante',['only' => 'create']);
        $this->middleware('gestor'); 
    }
    
    public function index()
    {
        $personas = Persona::All();
        $gestores = Gestor::All();

        if(Auth::user()->rols->nombre == "Infocenter")
            {
                return view('persona.index',compact('personas','gestores'));
            }
        else
         {
            return view('\persona\index2',compact('personas','gestores'));
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoDocumentos = TipoDocumento::lists('nombre','idTipoDocumento');
        $tipoPersonas = TipoPersona::lists('nombre','idTipoPersona');
        $lineas = LineaTecnologica::lists('nombre','idLineaTecnologica');
        $centros = CentroFormacion::lists('nombre','idCentroFormacion');
        return view('persona.create',compact('tipoDocumentos','tipoPersonas','lineas','centros'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaCreateRequest $request)
    {
        Persona::create([
        'numeroIdentificacion' => $request['numeroIdentificacion'],
        'nombres' => $request ['nombres'],
        'apellidos' => $request['apellidos'],
        'genero' => $request['genero'],
        'telefono' => $request['telefono'],
        'celular' => $request['celular'],
        'correo' => $request['correo'],
        'empresa' => $request['empresa'],
        'idTipoDocumento' => $request['idTipoDocumento'],
        'idTipoPersona' => $request['idTipoPersona'],  
        'idCentroFormacion' => $request['idCentroFormacion'],          
        ]);

        $tipoP = TipoPersona::find($request['idTipoPersona']); 

        if($tipoP->nombre == 'Gestor T1' || $tipoP->nombre == 'Gestor T2')
        {
            $id = Persona::where('numeroIdentificacion',$request['numeroIdentificacion'])->first();

            Gestor::create([
                'idPersona'=> $id->idPersona,
                'idLineaTecnologica' => $request['idLineaTecnologica'],
                ]);
        }

        return redirect('persona')->with('message','Persona registrada correctamente');
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
    public function edit($id)
    {
        $tipoDocumentos = TipoDocumento::lists('nombre','idTipoDocumento');
        $tipoPersonas = TipoPersona::lists('nombre','idTipoPersona');
        $persona = Persona::find($id);
        // $gestor = Gestor::where('idPersona', '=', $id)->first();
        $lineas = LineaTecnologica::lists('nombre','idLineaTecnologica');
        // $lineaGestor = $gestor->lineaTecnologicas->lists('nombre','idLineaTecnologica');
        // $lineaGestor = $gestor->lineaTecnologicas->nombre;
        $centros = CentroFormacion::lists('nombre','idCentroFormacion');        
        return view('persona.edit',['persona'=>$persona],compact('tipoDocumentos','tipoPersonas','lineas','centros', 'gestor', 'persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonaUpdateRequest $request, $id)
    {
        $persona = Persona::find($id);      
        $persona->fill($request->all());
        $persona->save();

        Session::flash('message','Persona modificada correctamente');
        return Redirect::to('persona');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->delete();
        Session::flash('message','Persona eliminada correctamente');
        return Redirect::to('persona');
    }
}
