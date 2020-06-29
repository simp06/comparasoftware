<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Software;
use App\Models\Lenguaje;
use App\Models\LenguajeSoftware;
use App\Models\Funcionalidad;
use App\Models\FuncionalidadSoftware;
class ComparaController extends Controller
{
    //
    public function index(){
        $lenguajes = Lenguaje::all()->pluck('nombre', 'id');
        $funcionalidades = Funcionalidad::all()->pluck('nombre', 'id');
        $softwares = Software::with(["funcionalidad:funcionalidad_id","lenguaje:lenguaje_id"])->get();
        return view('partepublica/homecompara',compact('softwares','lenguajes','funcionalidades'));
    }
}
