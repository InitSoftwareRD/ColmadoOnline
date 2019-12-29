<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserResquest;
use App\User;
use App\Customers;
use App\Exports\ClientesExport;
use App\Exports\EmpleadosExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{

    public function __construct()
   {
      $this->middleware(['auth','admin']);
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hash=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);   
        return view('admin.pages.user.users',compact('hash'));
    }

    public function CambiarPass()
    {
        return view('admin.pages.user.contrasena');

    }

    public function CambiarContrasena(Request $request)
    {
        if(!Hash::check($request->actual, Auth::user()->password))
        {
              return redirect()->route('CambiarContrasena')->with('actual', 'Contraseña actual incorrecta!');
        }

        $request->validate([
            'NuevaContrasena' => 'required|min:8|same:RepetirContrasena',
        ]);


        $user= User::find( Auth::user()->id);

        $user->password = bcrypt($request->NuevaContrasena);

        $user->save();
        
        return redirect()->route('CambiarContrasena')->with('status', 'Contraseña actualizada de manera correcta!');


    }

    public function ClientesExport() 
    {
        return Excel::download(new ClientesExport, 'ListadoClientes.xlsx');
    }

    public function EmpleadosExport() 
    {
        return Excel::download(new EmpleadosExport, 'ListadoEmpleados.xlsx');
    }

    public function personal()
    {
        $users=User::whereIn('rol_id', [2, 3])->get();

        return view('admin.pages.user.personal',compact('users'));

    }


    public function cliente()
    {
        $users=User::whereIn('rol_id', [1])->get();

        return view('admin.pages.user.clientes',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserResquest $request)
    {

        $user = new User;

        $user->name= $request->nombre;
        $user->last_name=$request->apellido;
        $user->sex = $request->sexo;
        $user->email= $request->correo;
        $user->password = bcrypt($request->contrasena);
        $user->phone =$request->celular;
        $user->status = 'A';
        $user->rol_id = $request->rol;

        $user->save();
       
         
        if($request->rol=='1')
        {
            $cliente = new Customers;

            $cliente->user_id = $user->id;

            $cliente->save();


        }


        return redirect()->route('user')->with('status', 'Usuario Registrado Correctamente!');
         

        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEmpleado(Request $request)
    {
        $user = User::findOrFail($request->id);
      
        $user->name= $request->nombre;
        $user->last_name = $request->apellido;
        $user->email = $request->correo;
        $user->phone = $request->celular;
        $user->rol_id = $request->rol;

        
        if( strlen($request->contrasena) > 0 )
        {
            $user->password = bcrypt($request->contrasena);
        }

        $user->save();


        return redirect()->route('personal')->with('status', 'Empleado Actualizado Correctamente!');

      
    
    }


    public function updateCliente(Request $request)
    {
        $user = User::findOrFail($request->id);
      
        $user->name= $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->sex = $request->sex;
        
        if( strlen($request->password) > 0 )
        {
            $user->password = bcrypt($request->password);
        }

        $user->save();


        return redirect()->route('cliente')->with('status', 'Cliente Actualizado Correctamente!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function EditEmpleado($id)
    {
        $user = User::findOrFail($id);
        

        return view('admin.pages.user.edit-personal',compact('user'));
    }

    public function EditCliente($id)
    {
        $user = User::findOrFail($id);
        
        return view('admin.pages.user.edit-cliente',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editStatus($id, $status)
    {
        $user = User::findOrFail($id);

        $mensaje="";

        if($status=='A')
        {
            $user->status='I';

            $mensaje = "Usuario Desactivado Correctamente";

                 
        }else
        {
            $user->status='A';

            $mensaje = "Usuario Activado Correctamente";

        }

        $user->save();

        return redirect()->route('personal')->with('status', $mensaje);
        
    }


    public function editStatusCliente($id, $status)
    {
        $user = User::findOrFail($id);

        $mensaje="";

        if($status=='A')
        {
            $user->status='I';

            $mensaje = "Usuario Desactivado Correctamente";

                 
        }else
        {
            $user->status='A';

            $mensaje = "Usuario Activado Correctamente";

        }

        $user->save();

        return redirect()->route('cliente')->with('status', $mensaje);
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
