<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        
        //$categories = DB::table('categories')->select('c_name')->first();
        $products = Products::get();


        //$category_name = Products::with('category')->where('id', $products->id)->first();
        //dd($category_name);
        //dd($categories);
        return view('products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // //
        // $categories = DB::table('categories')->select('id', 'c_name')->get();
        // dd($categories);
        $products1 = category::select('id', 'c_name')->get();

        return view('products.create', compact('products1'));
        //r``eturn view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|max:s20',
            'description' => 'required|max:255',
            'price' => 'required|numeric ',
            'image' => 'required| mimes:jpeg,bmp,png',
        ]);

        if ($request->hasFile('image')) {
            //
            $image = $request->file('image');
            $path = public_path('image');
            $name = time().rand(1, 99999) . "." . $image->getClientOriginalExtension();
            $image->move($path, $name);
            // dd($path);
        }

        $products = new Products();
        $products->name = $request->name;
        $products->description = $request->des;
        $products->price = $request->price;
        $products->image = isset($name) ? $name : "";
        
        $products->created_by = Auth::user()->role_id;
        $products->user_id = Auth::user()->id;
        // dd($products);

        $save = $products->save();
        $products1 =  $request->category;
        $products->category()->attach($products1);
        if ($save) {
            return redirect()->route('products.index');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $category = category::find($id)->products;
        // return view('products.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = products::with('category')->whereId($id)->first();
        if(isset($data)){
        if (Auth::user()->id == $data->user_id || Auth::user()->role_id==1) {
             
            $category = category::all();
           
           // dd($category,$products1);
           //dd($category);

            $products = Products::find($id);
            return view('products.edit', compact('products', 'category'));
        } else {
            return redirect()->route('products.index');
        }
        } else {
            return redirect()->route('products.index');
        }
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
        
        // $request->validate([
        //     'name' => 'required|max:s20',
        //     'description' => 'required|max:255',
        //     'price' => 'required|numeric',

        // ]);


        $products = Products::find($id);
        $products->name = $request->name;
        $products->description = $request->des;
        $products->price = $request->price;
       // $products->image = isset($name) ? $name : "";
        //$products->category =  implode(',', $request->category);
        // $products->user_role = $request->user_role;
        //   dd($products);
      $products->save();	
       
        $products1 =  $request->category;
        $products->category()->sync($products1);
        
            return redirect()->route('products.index');
        
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
        //
        $data = products::find($id);
        
        if (Auth::user()->id == $data->user_id || Auth::user()->role_id==1) {
             
            $products = Products::find($id);
            $products->category()->detach();
            Products::where('id', $id)->delete();

            return  redirect()->route('products.index');
        } else {
            return redirect()->route('products.index');
        }
    }
}