@extends('layouts.app')
@section('content')
<div class="container mb-3">
  <a href="{{route('categories.create')}}"><button type="button" class="btn btn-light">ADD category</button></a>
</div>
<div class="container">

<table id="myTable" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>user_role</th>
            <th>icon</th>
            <th>EDIT/DELETE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($category as $cat)
        <tr>
            <td>{{$cat->id}}</td>
            <td>{{$cat->c_name}}</td>
            <td>{{$cat->user_id}}</td>
            <td><img src="{{ url('icon/',$cat->icon) }}" width="60" height="50"></td>
            <td>
             
            <div class="btn-group" role="group" aria-label="Basic example">
                @if($cat->user_id == 1 || $cat->user_id == 2)
                 <a role="button" href="{{ route('categories.edit',$cat->id) }}"><button type="button" class="btn btn-warning mr-2"> edit</button></a>
               @endif

               @if($cat->user_id != 2 )
            <form action="{{ route('categories.destroy',$cat->id) }}" method="post" >
              <input type="hidden" name="_method" value="DELETE">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger" >delete</button>
            </form>  
            @endif 
        </div>           
            </td>
        </tr>
        @endforeach
           </tbody>
</table>
</div>
@endsection
