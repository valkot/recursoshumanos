<?php

namespace App\Http\Controllers;

use App\User;
use App\Perfil;
use App\Servicio;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $rut = isset($request->rut) ? str_replace(".","",request()->rut) : null;
        $users = User::with('perfil', 'servicio')
                ->when(!is_null($rut), function ($collection) use ($rut){
                    $collection->where('rut', $rut);
                }) 
                ->when($request->has('nombre') && !is_null($request->nombre), function ($collection) use ($request){
                    $collection->whereRaw("nombre LIKE ?", ['%'.$request->nombre.'%']);
                })
                ->paginate(10);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $perfiles = Perfil::get();
        $servicios = Servicio::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        return view('user.create', compact('perfiles', 'servicios'));
    }

    public function store(Request $request)
    {
        if(!isset($request->admin)){
            $request->request->add(['admin' => 0]);
        }
        $user = User::updateOrCreate(['id' => $request->id], $request->except('_token'));
        if($user){
            return redirect('/user')->with('message', $user->nombre." se ha creado correctamente");
        }else{
            return redirect('/user')->with('error', "No se ha podido crear al usuario");
        }
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        $perfiles = Perfil::get();
        $servicios = Servicio::where("bo_estado", 1)->orderBy('tx_descripcion')->get();

        return view('user.create', compact('user', 'perfiles', 'servicios'));
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        if($user->delete()){
            return redirect('/user')->with('error', $user->nombre." a sido eliminado correctamente");
        }else{
            return redirect('/user')->with('error', "El usuario no a sido eliminado, intente nuevamente");
        }
    }

    public function restaurar($id)
    {
        $user = User::onlyTrashed()->find($id)->restore();
        return redirect('/user/'.$id.'/edit')->with('message', "Se ha restaurado el usuario correctamente");
    }
}