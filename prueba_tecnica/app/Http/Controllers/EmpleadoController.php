<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Empleado;
use App\Models\Empleado_rol;
use App\Models\Roles;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $datosEmpleados['empleados'] = Empleado::select("empleados.id","empleados.nombre", "empleados.email", "empleados.sexo", "areas.nombre as area_nombre", "empleados.boletin")
        ->join("areas", "areas.id", "=", "empleados.area_id")
        ->orderBy("empleados.id", "DESC") 
        ->paginate(5);

        return view('empleado.index', $datosEmpleados);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $datoAreas['areas'] = Areas::all();//cargo todos los datos de las areas
        $datoRoles['roles'] = Roles::all();//cargo todos los datos de los roles

        return view("empleado.create", $datoAreas, $datoRoles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*----- validar campos ---------*/

        $field = [
            'nombre' => 'required|string|max:200',
            'email' => 'required|email|max:500',
            'sexo' => 'required|string',
            'area_id' => 'required|integer',
            'descripcion' => 'required|string',
            'role_id' => 'required|integer',
        ];

        $message = [
            'required' => 'El :attribute es requerido',
            'descripcion.required' => 'la descripcion es requerida',
            'area_id.required' => 'Debes seleccionar un area',
            'checkRole.required' => 'Debes seleccionar un rol',
            'sexorole_id' => 'Debes seleccionar un sexo',
            'identificacion' => 'La identificación es requerida'
        ];

        $this->validate($request, $field, $message);

        /* ---------------- */


        $datoEmpleado = request()->except('_token', 'role_id');//obtener datos del formulario execto el token y el role_id

        Empleado::insert($datoEmpleado);//inserto los datos en la db

        $trabajadorId = Empleado::select('id')->orderBy('id', 'desc')->first(); //obtengo el id del ultimo empleado registrado

        $trabId = (int)$trabajadorId->id;//convierto el id a un tipo de dato int
        $roleId = request('role_id');//obtengo el rol_id del formulario

        Empleado_rol::insert(['empleado_id'=>$trabId, 'rol_id'=>$roleId]);//inserto los datos en la tabla empleado_rols

        return redirect('empleado')->with('message', 'Producto registado con exito!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datoAreas['areas'] = Areas::all();//cargo todos los datos de las areas
        $datoRoles['roles'] = Roles::all();//cargo todos los datos de los roles
        $empleado = Empleado::findOrFail($id);//cargo los datos del empleado con el mismo id

        return view('empleado.edit', compact('empleado'))->with($datoAreas)->with($datoRoles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $field = [
            'nombre' => 'required|string|max:200',
            'email' => 'required|email|max:500',
            'sexo' => 'required|string',
            'area_id' => 'required|integer',
            'descripcion' => 'required|string',
            'role_id' => 'required|integer',
        ];

        $message = [
            'required' => 'El :attribute es requerido',
            'descripcion.required' => 'la descripcion es requerida',
            'area_id.required' => 'Debes seleccionar un area',
            'checkRole.required' => 'Debes seleccionar un rol',
            'sexorole_id' => 'Debes seleccionar un sexo',
            'identificacion' => 'La identificación es requerida'
        ];

        $this->validate($request, $field, $message);

        /* ---------------- */

     

        $datoEmpleado = request()->except(['_token', '_method', 'role_id']);


   
        Empleado::where('id', '=', $id)->update($datoEmpleado);

       return redirect("empleado")->with('message', 'Producto actualizado con exito!'); 

  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::destroy($id);//elimino el registro que contenga el id enviado

        return redirect('empleado')->with('message', 'Producto eliminado con exito!');

    }
}
