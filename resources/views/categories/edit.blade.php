@extends('layouts.app')
@section('content')

    <div class="container">
        <form action="{{ route('categories.update', $category->id) }}" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="id" value="{{ $category->id }}" hidden>
            <div class="mb-3">

                <label for="Product name" class="form-label">Name</label>
                <input type="text" class="form-control" id="" name="c_name" placeholder="Enter the name"
                    value="{{ $category->c_name }}">
                @if ($errors->has('c_name'))
                    <div class="text-danger">{{ $errors->first('c_name') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="c-name" class="form-label"> ADD Icons</label>
                <input type="file" class="form-control" id="icon" name="icon" placeholder="select icons">
                <img src="{{ url('icon/', $category->icon) }}" width="60" height="50">
                @if ($errors->has('icon'))
                    <div class="text-danger">{{ $errors->first('icon') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-outline-success">SUBMIT</button>
        </form>
        <div>

        @endsection
