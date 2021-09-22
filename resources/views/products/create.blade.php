@extends("layouts.app")
@section('content')
    <div class="container">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- <input type="text" name="id" placeholder="" value="{{ Auth::user()->id }}" hidden="true"> --}}

            <div class="mb-3">
                <label for="Product name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="" name="name" placeholder="Enter the name">
                @if ($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea class="form-control" id="" name="des" rows="3"></textarea>
                @if ($errors->has('des'))
                    <div class="text-danger">{{ $errors->first('des') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Select Product image</label>
                <input class="form-control" name="image" type="file" id="image">
                @if ($errors->has('image'))
                    <div class="text-danger">{{ $errors->first('image') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="Product price" class="form-label">price</label>
                <input type="text" class="form-control" name="price" id="" placeholder="Enter the price">
                @if ($errors->has('price'))
                    <div class="text-danger">{{ $errors->first('price') }}</div>
                @endif
            </div>
            {{-- <div class="mb-3">
  <label for="Product price" class="form-label">category Id</label>
  <input type="text" class="form-control" name ="category_id" id="" placeholder="Enter the category">
{{-- </div> --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>selct category</label>
                    <select class="form-control" multiple data-live-search="true" name="category[]">
                        <option value="" selected>select category</option>
                        @for ($i = 0; $i < count($products1); $i++)
                            <option value="{{ $products1[$i]->id }}">{{ $products1[$i]->c_name }}</option>
                        @endfor
                    </select>
                </div>
                @if ($errors->has('category'))
                    <div class="text-danger">{{ $errors->first('category') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-success">SUBMIT</button>
        </form>
        <div>
        @endsection
