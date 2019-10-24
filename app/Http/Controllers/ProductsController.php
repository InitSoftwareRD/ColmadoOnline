<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Categories;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $categories = Categories::all();

        return view('admin.pages.products.category',compact('categories'));
           
         
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
        $category->name=$request->category;
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
    public function edit($id)
    {
        //
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
