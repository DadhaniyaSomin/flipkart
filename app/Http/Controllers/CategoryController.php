<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        //
        $category = category::get();
        return view('categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if ($request->hasFile('icon')) {
            //
            $icon = $request->file('icon');
            $path = public_path('icon');
            $name = time().rand(1, 99999) . "." . $icon->getClientOriginalExtension();
            $icon->move($path, $name);
            // dd($path);
        }
     
        //
        $category = new Category();
        $category->c_name = $request->c_name;
        $category->created_by =  Auth::user()->role_id;
        $category->icon = isset($name) ? $name : ""; 
        //dd($category);
        $save = $category->save();
        if($category)
         {
             return redirect()->route('categories.index');
           }
        
    
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = category::find($id);
        
        if (Auth::user()->id == $data->user_id) {
        $category = category::find($id);
        return view('categories.edit', compact('category'));
      } 
         else {
         return redirect()->route('category.index');
           }
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = category::find($id);
        $category->c_name = $request->c_name;
        $save = $category->update();
        if($category)
        {
            return redirect()->route('categories.index');
        }

                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = category::find($id);
        
        if (Auth::user()->id == $data->user_id) {
        $category = category::where('id',$id)->delete();
        return redirect()->route('categories.index');
            
        } 
        else {
            return redirect()->route('category.index');
        }
}
}

