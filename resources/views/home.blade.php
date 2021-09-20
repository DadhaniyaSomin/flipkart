@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                       <h1> WELCOME ADMIN</h1>
                            <a href="{{route('products.index')}}"><button type="button" class="btn btn-primary"> Producst</button></a>
                            <a href="{{ route('categories.index') }}"><button type="button" class="btn btn-primary"> Category</button></a>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
