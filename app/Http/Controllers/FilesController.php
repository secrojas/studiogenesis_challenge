<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilesController extends Controller
{
    public function setRegistrarArchivo(Request $request)
    {
        $file = $request->file;
        $bandera = str::random(10);
        $filename = $file->getClientOriginalName();
        $fileserver = $bandera.'_'.$filename;

        Storage::putFileAs('public/users', $file, $fileserver);

         //se realiza consulta a la BBDD por procedimiento almacenado
         $respuesta = DB::select('call sp_Archivo_setRegistrarArchivo (?, ?)',
                                                        [
                                                            asset('storage/users/'.$fileserver),
                                                            $filename
                                                        ]);
        return $respuesta;
    }
}
