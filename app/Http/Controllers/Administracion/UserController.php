<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getListadoUsuarios(Request $request)
    {
        //se válida para que solo acceda si es por petición AJAX
        if(!$request->ajax()) return redirect('/');

        //se asignan los datos del request a cada variable
        $cNombre=$request->cNombre;
        $cUsuario=$request->cUsuario;
        $cCorreo=$request->cCorreo;
        $cEstado=$request->cEstado;

        //se válida si los datos del request son null. 
        //En caso de ser null se le asigna "vacio" sino se mantiene el valor
        $cNombre = ($cNombre == NULL) ? ($cNombre = ''): $cNombre;
        $cUsuario = ($cUsuario == NULL) ? ($cUsuario = ''): $cUsuario;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = ''): $cCorreo;
        $cEstado = ($cEstado == NULL) ? ($cEstado = ''): $cEstado;

        //se realiza consulta a la BBDD por procedimiento almacenado
        $respuesta = DB::select('call sp_Usuario_getListadoUsuarios (?, ?, ?, ?)',
                                                        [
                                                            $cNombre,
                                                            $cUsuario,
                                                            $cCorreo,
                                                            $cEstado
                                                        ]);
        return $respuesta;
    }

    public function setRegistrarUsuarios(Request $request)
    {
        //se válida para que solo acceda si es por petición AJAX
        if(!$request->ajax()) return redirect('/');

        //se asignan los datos del request a cada variable
        $cPrimerNombre=$request->cPrimerNombre;
        $cSegundoNombre=$request->cSegundoNombre;
        $cApellido=$request->cApellido;
        $cUsuario=$request->cUsuario;
        $cCorreo=$request->cCorreo;
        $cContrasena=Hash::make($request->cContrasena);
        $oFotografia=$request->oFotografia;

        //se válida si los datos del request son null. 
        //En caso de ser null se le asigna "vacio" sino se mantiene el valor
        $cPrimerNombre = ($cPrimerNombre == NULL) ? ($cPrimerNombre = ''): $cPrimerNombre;
        $cSegundoNombre = ($cSegundoNombre == NULL) ? ($cSegundoNombre = ''): $cSegundoNombre;
        $cApellido = ($cApellido == NULL) ? ($cApellido = ''): $cApellido;
        $cUsuario = ($cUsuario == NULL) ? ($cUsuario = ''): $cUsuario;
        $cCorreo = ($cCorreo == NULL) ? ($cCorreo = ''): $cCorreo;
        $cContrasena = ($cContrasena == NULL) ? ($cContrasena = ''): $cContrasena;
        $oFotografia = ($oFotografia == NULL) ? ($oFotografia = ''): $oFotografia;        
        
         //se realiza consulta a la BBDD por procedimiento almacenado
         $respuesta = DB::select('call sp_Usuario_setRegistrarUsuarios (?, ?, ?, ?, ?, ?, ?)',
                                                    [
                                                        $cPrimerNombre,
                                                        $cSegundoNombre,
                                                        $cApellido,
                                                        $cUsuario,
                                                        $cCorreo,
                                                        $cContrasena,
                                                        $oFotografia
                                                    ]);
        return $respuesta;
    }
}
