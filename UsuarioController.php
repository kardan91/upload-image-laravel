<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Direccion;
use App\Pais;
use App\Estado;
use App\Municipio;
use App\Ciudad;
use DB;
use Redirect;
use Image;

class UsuarioController extends Controller
{
    //
    public function activate($code){
    	//$usuarios = Usuario::where('celular',$code);
    	$usuarios = DB::table('usuario')
    					->leftJoin('direccion','usuario.iddireccion','=','direccion.iddireccion')
    					->where('remember_token',$code);
    	$existe = $usuarios->count();
    	$usuario = $usuarios->first();
    	//$id = $usuario->idusuario;
    	//$nombres = $usuario['nombres'];
    	
        if ($existe == 1 && $usuario->estado == 'I') {
            //$paises = Pais::all();
            //$estados = Estado::all()->where('nombre', '<>', '-');//DB::select("select * from estado where nombre <> '-'");//all();

            $usuario->celular="";
            return view('auth.login', compact('usuario'));//, 'paises', 'estados'));
        }else{
            return redirect::to('/');
        }
    	
    }

    /*public function index()
    {
        $estados = Estado::all();
        
        return View('completar_registro', compact('estados'));         
    }*/

    public function getMunicipios(Request $request, $id){
        //echo "ID: ".$id;
        //echo "::: ".$id;
        /*$idestado = $id;
        if($request->ajax()){
            $municipios = Municipio::municipios($id);
            //var_dump($municipios);
            return $municipios;
        }*/
        if($request->ajax()){
            //  echo "ENTRE";
            $municipios = DB::select("select * from municipio where idestado ='".$id."'");
            return $municipios;
        }
    }

    public function getCiudades(Request $request, $ide, $idm){
        //echo "DLDLDLD".$ide;
        /*if($request->ajax()){
            $ciudades = Ciudad::ciudades($ide, $idm);
            //var_dump($municipios);
            return $ciudades;
        }*/
        if($request->ajax()){
            //  echo "ENTRE";
            $ciudades = DB::select("select * from ciudad where idestado = '".$ide."' and idmunicipio = '".$idm."'");
            return $ciudades;
        }
    }

    public function editarPerfil()
    {
        # code...
        $idusuario = auth()->user()->idusuario;
        $usuario = Usuario::where('idusuario', $idusuario)->get();
        $usuario->each(function($usuario){
            if(!empty($usuario->direccion))
                $usuario->direccion;
        });
        //dd($usuario->direccion->calle);
        $usuario = $usuario[0];
        $paises = Pais::all();
        //$usuario->direccion->idpais;
        //dd($usuario->direccion);
        $estados = Estado::all()->where('nombre', '<>', '-');
        if(!empty($usuario->direccion->idestado)){
            $municipios = Municipio::all()->where('idestado', $usuario->direccion->idestado);
        }

        if(!empty($usuario->direccion->idmunicipio)){
            $ciudades = Ciudad::whereRaw("idestado ='".$usuario->direccion->idestado."' and idmunicipio ='".$usuario->direccion->idmunicipio."'")->get();
        }

        //dd($municipios);
        if(isset($usuario->direccion))
            return view('editprofile')->with('usuario', $usuario)->with('paises', $paises)->with('estados', $estados)->with('municipios', $municipios)->with('ciudades', $ciudades);
        else
            return view('editprofile')->with('usuario', $usuario)->with('paises', $paises)->with('estados', $estados);        
    }

    public function actualizarDatosTurista(Request $request){
        $nombreArchivo="";
        //dd($request->fotoperfil);
        if($request->fotoperfil != null){
            $this->validate($request, [
            'fotoperfil' => 'image'
            ]);
            $extension = $request->file('fotoperfil')->getClientOriginalExtension();
            $nombreArchivo = 'U'.auth()->user()->idusuario.'.'.$extension;
            Image::make($request->file('fotoperfil'))
                ->resize(300, 300)
                ->save('images/fotos/usuarios/'.$nombreArchivo);
        }
        $resultado = DB::select("select actualizarDatosPersonalesTurista(".auth()->user()->idusuario.", '".$request->appaterno."','".$request->apmaterno."', '".$request->nombres."', '".$request->genero."', '".$request->fechanac."', '".$request->celular."', '".$request->telefono."', '".$request->nombreusu."', '".$nombreArchivo."', null, null, null)");

        return $resultado[0]->actualizardatospersonalesturista;
    }

    public function actualizarDireccionTurista(Request $request){
        //dd($request);

        $resultado = DB::select("select actualizarDireccionTurista(".auth()->user()->idusuario.", '".$request->calle."', '".$request->numeroexterior."','".$request->numerointerior."', '".$request->colonia."', '".$request->pais."', '".$request->estado."', '".$request->municipio."', '".$request->ciudad."', '".$request->codigopostal."')");
        /*$consulta="select(select actualizarDireccionTurista(".$request->idusuario.", '".$request->calle."', '".$request->numeroexterior."','".$request->numerointerior."', '".$request->colonia."', '".$request->pais."', '".$request->estado."', '".$request->municipio."', '".$request->ciudad."', '".$request->codigopostal."'))";*/
        //dd($consulta);
        //dd($resultado[0]->actualizardireccionturista);
        //echo "consulta: " . $consulta;
        dd($resultado[0]->actualizardireccionturista);
    } 

    public function revisarUsername(Request $request){
        $resultado = -1;
        if ($request->nombreusu!=null) {
            $resultado = DB::select("select validarUsername(".auth()->user()->idusuario.",'".$request->nombreusu."')");
        } 

        return $resultado[0]->validarusername;
    }

    public function revisarPassword(Request $request){
        $resultado = -1;
        if ($request->passwordActual!=null) {
            $resultado = DB::select("select validarPassword(".auth()->user()->idusuario.",'".$request->passwordActual."')");
        }   

        return $resultado[0]->validarpassword;
    }

    public function actualizarPasswordTurista(Request $request){
        $this->validate($request, [
            'passwordActual' => 'required|string|min:6',
            'password' => 'required|string|min:6',
        ]);

        $resultado = DB::select("select actualizarPasswordTurista(".auth()->user()->idusuario.",'".$request->passwordActual."','".$request->password."')");
        //dd($resultado[0]->actualizarpasswordturista);
        //dd($request->passwordActual);
        return $resultado[0]->actualizarpasswordturista;
    }

    public function actualizarFotoPerfil(Request $request){
        $this->validate($request, [
            'fotoperfil' => 'required|image'
        ]);

        $extension = $request->file('fotoperfil')->getClientOriginalExtension();
        $nombreArchivo = 'U'.$request->idusuario.'.'.$extension;
        Image::make($request->file('fotoperfil'))
            ->resize(300, 300)
            ->save('images/fotos/usuarios/'.$nombreArchivo);
        //dd($extension);
        $resultado = DB::select("select actualizarFotoTurista(".$request->idusuario.", '".$nombreArchivo."')");
        dd($resultado[0]->actualizarfototurista);
        /*if($request->hasFile('fotoperfil')){
            $request->file('fotoperfil')->store('public');
        }*/
        
        /*if ($request->hasFile->file('fotoperfil')) {
            # code...
            var_dump($request);
        }*/
    }

    public function registrar(Request $request){
        //echo "pais: " . $request->idpais;
        //var_dump($request);
       $resultado = DB::select("select actualizarusuarioturista(".$request->idusuario.", '".$request->calle."', '".$request->numeroexterior."', '".$request->numerointerior."', '".$request->colonia."', '".$request->pais."', '".$request->estado."', '".$request->municipio."', '".$request->ciudad."', '".$request->codigopostal."', '".$request->password."', '".$request->appaterno."', '".$request->apmaterno."', '".$request->nombres."', '".$request->genero."', '".$request->fechanac."', '".$request->celular."', '".$request->telefono."', '".$request->nombreusu."')");

       var_dump($resultado);
       if($resultado[0]->actualizarusuarioturista==1){
            return view('auth.login');
       }
    }
}
