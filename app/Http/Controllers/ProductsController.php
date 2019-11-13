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

        $category = Categories::find($id);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
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
