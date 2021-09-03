<?php

namespace App\Http\Controllers;

use App\User;
use App\Perfil;
use App\Servicio;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('perfil', 'servicio')->paginate(10);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfiles = Perfil::get();
        $servicios = Servicio::where("bo_estado", 1)->orderBy('tx_descripcion')->get();
        return view('user.create', compact('perfiles', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset($request->admin)){
            $request->request->add(['admin' => 0]);
            // dd('dsad');
        }
        // dd($request->all());
        $user = User::updateOrCreate(['id' => $request->id], $request->except('_token'));
        if($user){
            return redirect('/user')->with('message', "El usuario se ha creado correctamente");
        }else{
            return redirect('/user')->with('error', "No se ha podido crear al usuario");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $perfiles = Perfil::get();
        $servicios = Servicio::where("bo_estado", 1)->orderBy('tx_descripcion')->get();

        return view('user.create', compact('user', 'perfiles', 'servicios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            return redirect('/user')->with('message', "El usuario a sido eliminado correctamente");
        }else{
            return redirect('/user')->with('error', "El usuario no a sido eliminado, intente nuevamente");
        }
    }

    public function restaurar($id)
    {
        User::onlyTrashed()->find($id)->restore();
        return redirect('/user/'.$id.'/edit')->with('message', "El usuario se ha creado correctamente");
    }
}
