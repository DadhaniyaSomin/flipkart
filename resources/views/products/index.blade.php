@extends('layouts.app')
@section('content')
<div class="container mb-3 ">
    <div class="row justify-content-between p-3 mb-4">
        <div class="col-5 ">
            <a href="{{route('products.create')}}"><button type="button">ADD PRODUCT</button></a>
        </div>
        {{-- @if(!(isset($category)))
        <div class="col-auto align-content-center align-self-stretch">
            <h1 class="mb-4">Select Category</h1>
            <form action="" method="GET" class="row g-3">
                <div class="col-auto">
                    <select class="form-select" id="inlineFormSelectPref" onchange="window.location.href=this.options[this.selectedIndex].value;">
                        <option selected>Choose...</option>
                        @for($i = 0 ; $i < count($categories) ; $i++) 
                        <option value="{{route('products.show',$categories[$i]->id)}}">{{$categories[$i]->c_name}}</option>
                       @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary mb-3">select category</button>
                </div>
            </form>
            <!-- <select class="form-select">
            <option value="" selected>select categories</option>
               @for($i = 0 ; $i < count($categories) ; $i++) 
              <option value="{{route('products.show',$categories[$i]->id)}}">{{$categories[$i]->c_name}}</option>
               @endfor 
         </select>   -->
        </div>
        @endif --}}
    </div>
</div>
<div class="container">

    <table id="myTable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>Description</th>
                <th>Price</th>
                {{-- <th>category</th> --}}
                <th>user role</th>
                <th>EDIT/DELETE</th>
                <th>image</th>
            </tr>
        </thead>
        <tbody>
            {{-- @if(isset($products)) --}}
          
            @foreach($products as $product)
          
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->price}}</td>
            {{-- <td>{{$product->category}}</td> --}}
            <td>{{$product->user_role}}</td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    @if($product->user_role == 1 || $product->user_role == 2)
                    <a role="button" href="{{ route('products.edit',$product->id) }}"><button type="button" class="btn btn-warning mr-2"> edit</button></a>    
                    @endif
                    @if($product->user_role != 2 )
                    <form action="{{ route('products.destroy',$product->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                    @endif
                </div>
            </td>
            <td><img src="{{ url('image/',$product->image) }}" width="60" height="50"></td>
            </tr>
            @endforeach
            {{-- @else
            @foreach($category as $cat)
            <td>{{$cat->id}}</td>
            <td>{{$cat->name}}</td>
            <td>{{$cat->description}}</td>
            <td>{{$cat->price}}</td>
            <td>{{$cat->category_id}}</td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a role="button" href="{{ route('products.edit',$cat->id) }}"><button type="button" class="btn btn-warning mr-2"> edit</button></a>
                    <form action="{{ route('products.destroy',$cat->id) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                </div>
            </td>
            </tr>
            @endforeach
           @endif --}}

        </tbody>
    </table>
</div>
@endsection