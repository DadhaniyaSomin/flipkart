@extends("layouts.app")
@section('content')
    <div class="container">
        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
            <div class="mb-3">
                <label for="c-name" class="form-label"> Name</label>
                <input type="text" class="form-control" id="" name="c_name" placeholder="Enter the name">
                @if ($errors->has('c_name'))
                    <div class="text-danger">{{ $errors->first('c_name') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="c-name" class="form-label"> ADD Icons</label>
                <input type="file" class="form-control" id="icon" name="icon" placeholder="select icons">
                @if ($errors->has('icon'))
                    <div class="text-danger">{{ $errors->first('icon') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-success">SUBMIT</button>
        </form>
        <div>
        @endsection
