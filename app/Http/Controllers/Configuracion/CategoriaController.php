<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoriaController extends Controller
{
    public function getListadoCategorias(Request $request)
    {
        //se válida para que solo acceda si es por petición AJAX
        if(!$request->ajax()) return redirect('/');

        //se asignan los datos del request a cada variable
       
        $cNombre=$request->cNombre;
        $cDescripcion=$request->cDescripcion;
        //se válida si los datos del request son null. 
        //En caso de ser null se le asigna "vacio" sino se mantiene el valor
        
        $cNombre = ($cNombre == NULL) ? ($cNombre = ''): $cNombre;
        $cDescripcion = ($cDescripcion == NULL) ? ($cDescripcion = '0' ) : $cDescripcion;

        //se realiza consulta a la BBDD por procedimiento almacenado
        $respuesta = DB::select('call sp_Categoria_getListadoCategorias (?, ?)',
                                                        [                                                                                                                        $cNombre,
                                                            $cNombre,
                                                            $cDescripcion
                                                        ]);
        return $respuesta;
    }
}
