@extends('layouts.app')
@section('content')
    @php
    $categoryArr = [];
    if (!($products->category->isEmpty())) {
        foreach ($products->category as $c) {
            $categoryArr[] = $c->category_id;
        }
    }
    @endphp
    <div class="container">
        <form action="{{ route('products.update', $products->id) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="id" value="{{ $products->id }}" hidden>

            <div class="mb-3">
                <label for="Product name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="" name="name" placeholder="Enter the name"
                    value="{{ $products->name }}">
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif

            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" id="" name="des" rows="3">{{ $products->description }}</textarea>
                @if ($errors->has('des'))
                    <div class="text-danger">{{ $errors->first('des') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="Product price" class="form-label">price</label>
                <input type="" class="form-control" name="price" id="" placeholder="Enter the price"
                    value="{{ $products->price }}">
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>selct category</label>
                    <select class="form-control" multiple data-live-search="true" name="category[]">

                        <option value=""> select category</option>
                        {{-- @foreach ($products1 as $prods)
              
                              <option value="{{$prods->id}}" @foreach ($category as $cats) @if ($cats->pivot_category_id == $prods->id)>{{$prods->c_name}}</option>
                              @endforeach --}}
                        @if (!$category->isEmpty())
                            @foreach ($category as $o)
                                <option value="{{ $o->id }}"
                                    {{ in_array($o->id, $categoryArr) ? 'selected' : ' ' }}>{{ $o->c_name }}</option>
                            @endforeach
                        @endif
                        {{-- @foreach ($item->subjectlist as $sublist){{$sublist->pivot->subject_id == $sub->id ? 'selected': ''}}   @endforeach> {{ $sub->name }} --}}
                    </select>
                </div>
            </div>


            <button type="submit" class="btn btn-outline-success">SUBMIT</button>
        </form>
        <div>

        @endsection
