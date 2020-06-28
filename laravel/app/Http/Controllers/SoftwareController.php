<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Software;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\File;
use App\Models\Lenguaje;
use App\Models\LenguajeSoftware;
class SoftwareController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //Obtengo todos los software
      
        $softwares= Software::select('nombre','id','descripcion')->get();
        return response()->json( $softwares );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Selec
        //Obtengo todos los lenguajes
        $lenguajes = Lenguaje::all()->pluck('nombre', 'id');
        
        return response()->json([
            'lenguajes' => $lenguajes,
            #'lenguaje' => Form::find($id),
            #'formFields' => FormField::where('form_id', '=', $id)->get(),
            #'options' => $formService->getFormOptions(),
            #'roles'   => $rolesService->get(),
            #'formRoles' => $formService->getBreadRoles($id),    
        ]);
    }
    public function validarData(Request $request){
        $validatedData = $request->validate([
            'nombre'             => 'required|min:1|max:64',
            'descripcion'           => 'required|max:1024',
        ]);
        return $validatedData;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData =$this->validarData($request);
        //Guardo todos los datos que corresponden a la tabla software
        $software= Software::create($request->all());
        //Guardo los lenguajes y los sincronizo con el input de lenguaje 
        $software->lenguaje()->sync($request->input('lenguaje', []));
        //Devuelvo el id del software para luego hacer la subida de imagen 
        return response()->json( ['status' => 'success','id'=>$software->id] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $software = DB::table('software')->where('id', '=', $id)->first();
        $statuses = DB::table('status')->select('status.name as label', 'status.id as value')->get();
        return response()->json( [ 'statuses' => $statuses, 'software' => $software ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtengo todos los lenguajes
        $lenguajes = Lenguaje::select('nombre','id')->get();
        //Busco el software
        $software= Software::select('nombre','id','descripcion','imagen')->where("id","=",$id)->first();
        //Busco el lenguaje seleccionado
        $lenguajeSeleccionado= LenguajeSoftware::select('lenguaje_id')->where("software_id","=",$id)->get();
        return response()->json( [ 'software' => $software ,"lenguajes"=>$lenguajes,"lenguajeSeleccionado"=>$lenguajeSeleccionado] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $validatedData =$this->validarData($request);
        $software = Software::find($id);
         //Guardo todo al igual que en el store
        $software->update($request->all());
        $software->lenguaje()->sync($request->input('lenguaje', []));
        return response()->json( ['status' => 'success'] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Notes::find($id);
        if($note){
            $note->delete();
        }
        return response()->json( ['status' => 'success'] );
    }
    public function subirImagen($id, Request $request){
       
        if($request->hasFile('imagen')) {
            $request->validate([
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $software = Software::find($id);
            Storage::delete("/public/".$software->imagen);      
            $path = storage_path('public/imagenes_software/');
         
            $image_path = Storage::disk('public')->put('imagenes_software', $request->file('imagen'));
            $image_path = isset($image_path) ?  "storage/".$image_path : "";
            $software->imagen = $image_path;
            $software->save();
            return response()->json( ['status' => 'success','path'=>$image_path] );
        }
    }
}
