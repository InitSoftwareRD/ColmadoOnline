<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductosRequest;
use App\Categories;
use App\Products;
use App\ImageProducts;

class ProductsController extends Controller
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
        $categories = Categories::all();
        return view('admin.pages.products.create',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $categories = Categories::where('status','A')->get();

        return view('admin.pages.products.category',compact('categories'));
           
    }


    public function create(ProductosRequest $request)
    {
        $productos = new Products;
        $imagen= new ImageProducts;

        $name="";
        if($request->hasFile('portada'))
        {
             $file = $request->file('portada');
             $name = time().$file->getClientOriginalName();
             $file->move(public_path().'/images/',$name);

        }

        $productos->name= $request->nombre;
        $productos->category_id=$request->categoria;
        $productos->description=$request->descripcion;
        $productos->ingredients=$request->ingredientes;
        $productos->price= $request->precio;
        
        $productos->save();

        $imagen->ruta = 'images/'.$name;
        $imagen->product_id = $productos->id;
        $imagen->tipo='P';

        $imagen->save();

        

        return redirect()->route('producto')->with('status', 'Producto creado de manera correcta!');


             
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_category(CategoryRequest $request)
    {
        $category=new Categories;
        $category->name=$request->categoria;
        $category->status='A';

        $category->save();


        return redirect()->route('category')->with('status', 'Categoria creada de manera correcta!');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categorystatus($id,$status)
   {

        $category = Categories::findOrFail($id);

        $mensaje="";

        if($status=='A')
        {
            $category->status='I';

            $mensaje = "Categoria desactivada Correctamente";

                 
        }else
        {
            $category->status='A';

            $mensaje = "Categoria activada Correctamente";

        }

        $category->save();

        return redirect()->route('category')->with('status', $mensaje);
        //
    }


    public function Productostatus($id,$status)
   {

        $producto = Products::findOrFail($id);

        $mensaje="";

        if($status=='A')
        {
            $producto->status='I';

            $mensaje = "Producto desactivado Correctamente";

                 
        }else
        {
            $producto->status='A';

            $mensaje = "Producto activado Correctamente";

        }

        $producto->save();

        return redirect()->route('editar-producto')->with('status', $mensaje);
        //
    }


    public function Listar()
    {
        $productos = Products::all();

        return view('admin.pages.products.edit_product',compact('productos'));

    }

    public function Mostrar( $id )
    {
        $producto = Products::findOrFail($id);
        $categorias = Categories::where('status','A')->get();

        return view('admin.pages.products.edit_product_fragment',compact(['producto','categorias']));
    } 


    public function update(Request $request)
    {
        $productos = Products::findOrFail($request->id);
        $imagen= ImageProducts::findOrFail($request->imagen);

        $name="";

        if($request->hasFile('portada'))
        {
             $file = $request->file('portada');
             $name = time().$file->getClientOriginalName();
             $file->move(public_path().'/images/',$name);

             $imagen->ruta = 'images/'.$name;
             $imagen->save();
        }

        $productos->name= $request->nombre;
        $productos->category_id=$request->categoria;
        $productos->description=$request->descripcion;
        $productos->ingredients=$request->ingredientes;
        $productos->price= $request->precio;
        
        $productos->save();

        

        return redirect()->route('editar-producto')->with('status', 'Producto Actualizado de manera correcta!');
        
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
