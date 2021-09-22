@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ route('products.update', $products->id)}}" method="post" >
<input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
 <input type="text"   name="id"  value="{{$products->id}}" hidden > 

 <div class="mb-3">

  <label for="Product name" class="form-label">Product Name</label>
  <input type="text" class="form-control" id="" name="name" placeholder="Enter the name" value="{{$products->name}}">
</div>
<div class="mb-3">
  <label for="" class="form-label">Description</label>
  <textarea class="form-control" id="" name="des"rows="3" >{{$products->description}}</textarea>
</div>
<div class="mb-3">
  <label for="Product price" class="form-label">price</label>
  <input type="" class="form-control" name ="price" id="" placeholder="Enter the price" value="{{$products->price}}">
</div>
<div class="col-md-4">
  <div class="form-group">
     <label>selct category</label>
     <select class="form-control" multiple data-live-search="true" name="category[]">
      
        <option value=""> select category</option>
          {{-- @foreach($products1 as $prods)
              
               <option value="{{$prods->id}}" @foreach($category as $cats) @if( $cats->pivot_category_id == $prods->id )>{{$prods->c_name}}</option>
          @endforeach --}}
          @for($i = 0 ; $i < count($products1) ; $i++) 
          <option value="{{$products1[$i]->id}}" 
           @foreach ( $products1 as $cp )
             @foreach ( $category as $cat ) 
             {{ $cp->id == $cat->category_id  ? 'selected' : ' '}}  
              @endforeach
           @endforeach
          >{{$products1[$i]->c_name}}</option>
          @endfor
        {{-- @foreach($item->subjectlist as $sublist){{$sublist->pivot->subject_id == $sub->id ? 'selected': ''}}   @endforeach> {{ $sub->name }} --}}
     </select>
  </div> 
</div>
<div class="mb-3">
  <label for="formFile" class="form-label">Select Product image</label>
  <input class="form-control" name="image"type="file" id="image">
  <img src="{{ url('image/',$products->image) }}" width="60" height="50">
</div>


<div class="mb-3">
  <label for="Product price" class="form-label">user_role</label>
  <input type="" class="form-control" name ="user_role" id="" placeholder="Enter the user role" value="{{$products->created_by}}" disabled>
</div>

<button type="submit" class="btn btn-outline-success">SUBMIT</button>
</form>
<div>  

@endsection
